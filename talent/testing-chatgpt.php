<?php
require 'vendor/autoload.php';

use Smalot\PdfParser\Parser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

// Function to extract text from a PDF file
// Function to extract text from a PDF file
function extractTextFromPdf($filePath) {
    $parser = new Parser();
    try {
        $pdf = $parser->parseFile($filePath);
        return $pdf->getText();
    } catch (Exception $e) {
        echo "Error parsing PDF: " . $e->getMessage();
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
    $text = preg_replace('/\b[A-Z][a-z]* [A-Z][a-z]*\b/', '[name]', $text);

    return $text;
}

// Function to get structured data from ChatGPT
function getStructuredDataFromChatGPT($apiKey, $text) {
    $client = new Client();

    $prompt = <<<PROMPT
Extract detailed structured information from the following CV text:

$text

Please provide the information in JSON format with the following fields:
- work_experience (an array of objects with fields: company, position, start_date, end_date, description)
- education (an array of objects with fields: institution, degree, field_of_study, start_date, end_date)
- skills (an array of strings)

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
        echo "Full API response:\n";
        print_r($data);

        if (isset($data['choices'][0]['message']['content'])) {
            // Extract the JSON content from the response
            $jsonContent = $data['choices'][0]['message']['content'];

            // Remove the surrounding backticks and "json" keyword
            $jsonContent = trim($jsonContent, "```json\n```");

            // Decode the JSON content
            return json_decode($jsonContent, true);
        } else {
            echo "Invalid response structure.\n";
            return null;
        }
    } catch (ClientException $e) {
        echo "Client error: " . $e->getMessage() . "\n";
        echo "Response body: " . $e->getResponse()->getBody() . "\n";
        return null;
    } catch (RequestException $e) {
        echo "Request error: " . $e->getMessage() . "\n";
        return null;
    } catch (Exception $e) {
        echo "An unexpected error occurred: " . $e->getMessage() . "\n";
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
        echo "File successfully uploaded.\n";

        $text = extractTextFromPdf($uploadFile);

        if ($text) {
            // Anonymize the text
            $anonymizedText = anonymizeText($text);

            $info = getStructuredDataFromChatGPT($apiKey, $anonymizedText);

            if ($info) {
                
    // Correct work experience dates
    if (isset($info['work_experience']) && is_array($info['work_experience'])) {
        foreach ($info['work_experience'] as &$experience) {
            $candidate->addExperience($exp['company'], $exp['position'], $exp['start_date'], $exp['end_date'],$status);
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
        } else {
            echo "Failed to extract text from PDF.\n";
        }
    } else {
        echo "Failed to move uploaded file.\n";
    }
} else {
    echo "No file uploaded or there was an upload error.\n";
}
?>
