<?php
use PHPUnit\Framework\TestCase;

class EmployeeApiTest extends TestCase
{
    private $baseUrl = "http://localhost/employeemanagement/test";

    public function test_create_employee()
    {
        $postData = [
            "full_name" => "David Hangula",
            "position" => "Software Engineer",
            "salary" => 60000,
            "employer_id" => 1
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->assertEquals(201, $httpCode, "Failed to create employee");
        $this->assertJson($response);
        $responseData = json_decode($response, true);
        $this->assertArrayHasKey('id', $responseData);
    }

 
    public function test_delete_employee()
    {
        $employeeId = 1;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->baseUrl}/{$employeeId}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->assertEquals(200, $httpCode, "Failed to delete employee");
    }
}
