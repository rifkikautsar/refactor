<?php

namespace App\Services;

use App\Services\Service;
use App\Response\ApiResponse;
use Illuminate\Support\Facades\File;
use Google\Cloud\Storage\StorageClient;
use App\Repositories\Scan\ScanRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScanService {
    private $scanRepository;

    public function __construct(ScanRepositoryInterface $scanRepository) {
        $this->scanRepository = $scanRepository;
    }

    /**
     * store image to google cloud storage
     * @return mixed
     */
    public function storeImageToGCS(object $request) {
        $data = $request->validated();
        
        // load credentials GCP
        $credentials = storage_path() . "/bustling-bot-350614-5dab7679f2d4.json";

        // initialize storage client
        $storage = new StorageClient([
            'projectId' => 'bustling-bot-350614',
            'keyFile' => json_decode(File::get($credentials),true)
        ]);
        
        $imageFile = $request->file('uploads');
        $imagePath = $imageFile->getRealPath();
        $bucketName = 'kulitku-incubation';
        $imageName = Service::generateFileName($data['uploads']); 
        $cloudPath = 'images/' . $imageName;

        // upload image to GCS
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload(file_get_contents($imagePath), [
            'name' => $cloudPath
        ]);

        // set image permission to public
        $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
        $urlImage = "https://storage.googleapis.com/".$bucketName."/".$cloudPath;

        $imageData = (object) [
            "userId" => $data['user_id'],
            "imageName" => $imageName,
            "urlImage" => $urlImage
        ];
        return $imageData;
    }

    /**
     * send image to AI Server
     * @return mixed
     */
    public function sendImageToAI($imageName) {
        // url AI Server
        $url = "https://asia-southeast2-bustling-bot-350614.cloudfunctions.net/predicts";
        $payload = json_encode(['image' => $imageName]);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = (array) json_decode(curl_exec($ch));
        curl_close($ch);
        
        return $result;
    }

    /**
     * get reccomendation from database
     * @return mixed
     */
    public function getReccomendation($prediction) {
        $disease = $prediction['class'];
        $reccomendationData = [];

        try{
            $getInfoDiseases = $this->scanRepository->getDiseaseByName($disease);
        
            // set array of reccomendation data
            $reccomendationData['result'] = $prediction;
            $reccomendationData['kandungan'] = Service::generateNameArray($getInfoDiseases->kandungan, "name");
            $reccomendationData['saran'] = Service::generateNameArray($getInfoDiseases->rekomendasi, "name");
            $reccomendationData['larangan'] = Service::generateNameArray($getInfoDiseases->larangan, "name");

            return ApiResponse::create(200, "Success", $reccomendationData);
        } catch (ModelNotFoundException $exception) {
            $message = "Error: ".$exception->getMessage();

            return ApiResponse::create(400, $message, null);
        }
    }

    /**
     * store scan data to database
     * @return mixed
     */
    public function storeScanData($dataScan, $imageData) {
        // get disease id
        $dataScan['diseaseId'] = $this->scanRepository->getDiseasesIdByName($dataScan['class']);
        
        $storeData = $this->scanRepository->storeScanData((object) $dataScan, $imageData);

        return $storeData;
    }

}