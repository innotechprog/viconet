<?php
session_start();
include "include/connect.php";
include "include/functions.php";
include "include/create-profile-auth.php";
$candidate->address();
$candidate->getCvData();
$candidate->setDate();
//
require 'vendor/autoload.php';

use Smalot\PdfParser\Parser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
//

$skills = ""; $education = ""; $previousExperience; $current_company; $status=""; 

// Function to extract text from a PDF file
function extractTextFromPdf($filePath) {
    $parser = new Parser();
    try {
        $pdf = $parser->parseFile($filePath);
        return $pdf->getText();
    } catch (Exception $e) {
        //echo "Error parsing PDF: " . $e->getMessage();
        return null;
    }
}

// Function to anonymize personal information
function anonymizeText($text) {
    // Replace email addresses
    $text = preg_replace('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', '[email]', $text);

    // Replace phone numbers (assuming a simple pattern, adjust as needed)
    $text = preg_replace('/\b\d{3}[-.\s]??\d{3}[-.\s]??\d{4}\b/', '[phone]', $text);

    // Replace names (this is more complex and may require a list of common names or other logic)
    //$text = preg_replace('/\b[A-Z][a-z]* [A-Z][a-z]*\b/', '[name]', $text);
    //$text = preg_replace('/\b[A-Z][a-z]* [A-Z][a-z]*\b/', '[address]', $text);

    return $text;
}

// Function to get structured data from ChatGPT
function getStructuredDataFromChatGPT($apiKey, $text) {
    $client = new Client();

    $prompt = <<<PROMPT
Extract detailed structured information from the following CV text:

$text

Please provide the information in JSON format with the following fields:

- summary: A brief overview or summary of the candidate's profile.
- skills: An array of strings listing the skills mentioned in the CV.

- work_experience: An array of objects, each containing(
company: The name of the company.
position: The job title or position held.
start_date: The start date of the employment. Leave it as an empty string if not available.
end_date: The end date of the employment. Leave it as an empty string if not available. If the end date is "present" or "current" set the employment_status to "Current"
description: A description of the job responsibilities, achievements, or any other relevant details.
employment_status: Set to "Current" if the end date is "present" or "current," otherwise "Post")
- education: An array of objects, each containing (

institution: The name of the educational institution.
degree: The degree obtained.
field_of_study: The field of study or major.
start_date: The start date of the education. Leave it as an empty string if not available.
end_date: The end date of the education. Leave it as an empty string if not available.
)
Additional Guidelines:

Ensure that all relevant data is extracted from the CV text, leaving nothing out.
For any dates that are not in a recognizable date format, leave the start_date and end_date fields as empty strings.
If the end_date is listed as "present" or "current" set employment_status to "Current"
If the employment_status cannot be determined, default it to "Post"
PROMPT;

    try {
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 1500,
            ],
            'timeout' => 30,
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        // Debugging: Print the full response
        //echo "Full API response:\n";
        //print_r($data);

        if (isset($data['choices'][0]['message']['content'])) {
            // Extract the JSON content from the response
            $jsonContent = $data['choices'][0]['message']['content'];

            // Remove the surrounding backticks and "json" keyword
            $jsonContent = trim($jsonContent, "```json\n```");

            // Decode the JSON content
            return json_decode($jsonContent, true);
        } else {
            //echo "Invalid response structure.\n";
            return null;
        }
    } catch (ClientException $e) {
       // echo "Client error: " . $e->getMessage() . "\n";
       // echo "Response body: " . $e->getResponse()->getBody() . "\n";
        return null;
    } catch (RequestException $e) {
       // echo "Request error: " . $e->getMessage() . "\n";
        return null;
    } catch (Exception $e) {
        //echo "An unexpected error occurred: " . $e->getMessage() . "\n";
        return null;
    }
}


// Main script execution
$apiKey = 'sk-proj-ccOIItdIOscec6Lp7zdxT3BlbkFJ1PnQg0ztvbVKhMUjNPg2';

// Check if a file has been uploaded
if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'cv/';
    $uploadFile = $uploadDir . basename($_FILES['cv']['name']);

    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($_FILES['cv']['tmp_name'], $uploadFile)) {
    	$filename = $_FILES['cv']['name'];
        //echo "File successfully uploaded.\n";
    	$candidate->addCv($filename);
        $text = extractTextFromPdf($uploadFile);

        if ($text) {
            // Anonymize the text
            $anonymizedText = anonymizeText($text);

            $info = getStructuredDataFromChatGPT($apiKey, $anonymizedText);

            if ($info) {
                
    // Correct work experience dates
    if (isset($info['work_experience']) && is_array($info['work_experience'])) {
        foreach ($info['work_experience'] as &$exp) {
            $candidate->addExperience($exp['company'], $exp['position'], $exp['start_date'], $exp['end_date'],strtolower($exp['employment_status']));
            //echo $exp['employment_status'];
            if(strtolower($exp['employment_status']) == "current")
            {
                $candidate->addKeyRole($seemail,$exp['description']);
            }
        }
    }
    // Correct education dates
    if (isset($info['education']) && is_array($info['education'])) {
        foreach ($info['education'] as &$education) {
            $candidate->addQualificationFromCV($education['institution'], $education['degree'],$education['end_date'],$education['field_of_study']);
        }
    }
    if (isset($info['skills']) && is_array($info['skills'])) {
        foreach ($info['skills'] as &$skill) {
            $candidate->addKeySkills($skill);
        }
    }
    if (isset($info['summary'])) {
            $candidate->addBio($info['summary']);
        
    }
        } else {
           echo "Failed to extract text from PDF.\n";
        }
    } else {
        echo "Failed to move uploaded file.\n";
    }
} else {
    echo "No file uploaded or there was an upload error.\n";
}
//update tab 1
$DOB = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
$gender = $_POST['gender'];
if($gender == "other"){
    $gender = $_POST['otherGender'];
}
$race =$_POST['race'];
$state = $_POST['state'];
$country = $_POST['country'];
$address = $_POST['address'];
$date=""; 


//update tab 2
if(isset($_POST['experience_id1'])){
    $exp1 =$_POST['experience_id1'];
}
if(isset($_POST['years_experience']))
{
    $years_experience = $_POST['years_experience'];
}
//
if(isset($_POST['userCellphone']))
{
    $cellphone = $_POST['userCellphone'];
    $sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender', c_cellphone ='$cellphone' WHERE md5(c_email)='$seemail'");
$sql->execute();
}
else{
$sql = $db->prepare("UPDATE `candidate_tbl` SET `c_DOB`='$DOB', race='$race' , gender ='$gender' WHERE md5(c_email)='$seemail'");
$sql->execute();
}

if($candidate->countAddress() > 0)
{
    $a_sql = $db->prepare("UPDATE `address` SET `address`=?,`state`=?,`country`=? WHERE email =?");
    $a_sql->execute(array($address,$state,$country,$seemail));
}
else{
$check_query = $db->prepare("SELECT * FROM address WHERE email='$seemail'");
$check_query->execute();
$check_row = $check_query->fetch();
if($check_row['address'] != $address){
$address_sql = $db->prepare("INSERT INTO `address`(`email`, `address`,`state`, `country`) VALUES (?,?,?,?)");
$address_sql->execute(array($seemail,$address,$state,$country));
}
}
}

?>

<script>window.location ="save_profile"</script>
