<?php
require('fpdf183/fpdf.php');
date_default_timezone_set('Asia/Manila');
session_start();


class Model{
    private $limit = 25;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ssre_databse";
    private $conn;

    function __construct(){
        $this->conn = new mysqli($this->servername , $this->username , $this->password , $this->dbname);
        if($this->conn->connect_error){
            echo 'Connection Failed';
        }
        else {
            return $this->conn;
        }
    }

    public function insertData($post){
        $dDate;
        $receipt;
        $price = 'Computing';
        $status = 'Processing';
        $pickDate = $post['pickDate'];
        $modePayment = $post['modePayment'];
        $pCont = ucwords($post['packageContent']);
        $courier = $post['courier'];
        if(empty($post['dDate'])){
            $dDate = date("m/d/Y");
        } else {
            $dDate = $post['dDate'];
        }

        // SENDER'S INFORMATION
        $sFName = ucwords($post['sFName']);
        $sMI = strtoupper($post['sMI']) . '.';
        $sLName = ucwords($post['sLName']);
        $sAddress = ucwords($post['sAddress']);
        $sCNum = $post['sCNum'];
        
        // RECEIVER'S INFORMATION
        $rFName = ucwords($post['rFName']);
        $rMI = strtoupper($post['rMI']) . '.';
        $rLName = ucwords($post['rLName']);
        $rAddress = ucwords($post['rAddress']);
        $rCNum = $post['rCNum'];

        // 1st SQL TO GET THE COUNT OF DATABASE
        $initSQL = "SELECT COUNT(sID) as total FROM servicerep";
        $initResult = $this->conn->query($initSQL);
        if($initResult){
            $data = $initResult->fetch_assoc();
            if($courier === "Motor Courier"){
                if($data['total']>9){
                    $receipt = '000'.$data['total'].date("Y").'MTRCL';
                } elseif($data['total']>99){
                    $receipt = '00'.$data['total'].date("Y").'MTRCL';
                } elseif($data['total']>999){
                    $receipt = '0'.$data['total'].date("Y").'MTRCL';
                } elseif($data['total']>9999){
                    $receipt = $data['total'].date("Y").'MTRCL';
                } else {
                    $receipt = '0000'.$data['total'].date("Y").'MTRCL';
                }
            } elseif($courier === "Car Courier #1"){
                if($data['total']>9){
                    $receipt = '000'.$data['total'].date("Y").'CRWAN';
                } elseif($data['total']>99){
                    $receipt = '00'.$data['total'].date("Y").'CRWAN';
                } elseif($data['total']>999){
                    $receipt = '0'.$data['total'].date("Y").'CRWAN';
                } elseif($data['total']>9999){
                    $receipt = $data['total'].date("Y").'CRWAN';
                } else {
                    $receipt = '0000'.$data['total'].date("Y").'CRWAN';
                }
            } elseif($courier === "Car Courier #2"){
                if($data['total']>9){
                    $receipt = '000'.$data['total'].date("Y").'CRTWO';
                } elseif($data['total']>99){
                    $receipt = '00'.$data['total'].date("Y").'CRTWO';
                } elseif($data['total']>999){
                    $receipt = '0'.$data['total'].date("Y").'CRTWO';
                } elseif($data['total']>9999){
                    $receipt = $data['total'].date("Y").'CRTWO';
                } else {
                    $receipt = '0000'.$data['total'].date("Y").'CRTWO';
                }
            }
        } else {
            return $this->conn->error;
        }

        // 2nd SQL FOR MAIN DATABASE TABLE
        $sql = "INSERT INTO servicerep (sFName, sMI, sLName, sAddress, sCNum, rFName, rMI, rLName, rAddress, rCNum, courier, deliveryDate, dateReceived, packContent, modePayment, status, price, receiptNo) VALUES ('$sFName', '$sMI', '$sLName', '$sAddress', '$sCNum', '$rFName', '$rMI', '$rLName', '$rAddress', '$rCNum', '$courier', '$dDate', '$pickDate', '$pCont', '$modePayment', '$status', '$price', '$receipt')";
        $result = $this->conn->query($sql);
        if(!$result){
            return $this->conn->error;
        } elseif($result){
            header('location:./urls/thank-you.php?order-number='.$receipt);
        }
    }

    public function searchOrderNumber($post){
        $orderNumber = $post['trackNum'];
        $sql = "SELECT receiptNo FROM servicerep WHERE receiptNo = '$orderNumber'";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return null;
        }
    }

    public function displayOrderDetails($orderNumber){
        $sql = "SELECT * FROM servicerep WHERE receiptNo = '$orderNumber'";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function countAllOrders(){
        $sql = "SELECT COUNT(*) as allOrders FROM servicerep";
        $result = $this->conn->query($sql);
        if($result){
            $data = $result->fetch_assoc();
            return $data['allOrders'];
        }
        else{
            echo 'failed';
        }
    }

    public function countDeliveries(){
        $sql = "SELECT COUNT(*) as allOrders FROM servicerep WHERE status = 'For Delivery' OR status = 'On The Way'";
        $result = $this->conn->query($sql);
        if($result){
            $data = $result->fetch_assoc();
            return $data['allOrders'];
        }
        else{
            echo 'failed';
        }
    }

    public function countNewOrders(){
        $sql = "SELECT COUNT(*) as allOrders FROM servicerep WHERE status = 'Processing' AND price = 'Computing'";
        $result = $this->conn->query($sql);
        if($result){
            $data = $result->fetch_assoc();
            return $data['allOrders'];
        }
        else{
            echo 'failed';
        }
    }

    public function allOrders($pageNum){
        $start = ($pageNum - 1) * $this->limit;
        $sql = "SELECT * FROM servicerep ORDER BY sID DESC LIMIT $start, $this->limit";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        } else{
            return null;
        }
    }

    public function newOrders($pageNum){
        $start = ($pageNum - 1) * $this->limit;
        $sql = "SELECT * FROM servicerep WHERE status = 'Processing' AND price = 'Computing' ORDER BY sID DESC LIMIT $start, $this->limit";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        } else{
            return null;
        }
    }

    public function pendingDeliveries($pageNum){
        $start = ($pageNum - 1) * $this->limit;
        $sql = "SELECT * FROM servicerep WHERE status = 'For Delivery' OR status = 'On The Way' ORDER BY sID DESC LIMIT $start, $this->limit";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        } else{
            return null;
        }
    }

    public function adminCredentials($post){
        $username = $post['username'];
        $password = $post['password'];

        $sql = "SELECT username FROM admincredentials WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $_SESSION['user'] = ucwords($row['username']);
            header('location:./admin.php');
        } else {
            header('location:login.php?Error=Please check admin credentials');
        }
    }

    public function logout(){
        session_destroy();
        header('location:./login.php');
    }

    public function updateOrderDetails($post){
        $courier = $post['courier'];
        $status = $post['status'];
        $price = "Php ".$post['price'].".00";
        $receiptNo = $post['receiptNo'];

        $sql = "UPDATE servicerep SET courier = '$courier', status = '$status', price = '$price' WHERE receiptNo = '$receiptNo'";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
    }

    public function generateReceipt($post){
        $pdf = new FPDF();
        $receipt = $post['receiptNo'];
        $sName = $post['sName'];
        $sAddress = $post['sAddress'];
        $sContact = $post['sContact'];
        $rName = $post['rName'];
        $rAddress = $post['rAddress'];
        $rContact = $post['rContact'];
        $package = $post['package'];
        $modePayment = $post['modePayment'];
        $courier = $post['courier'];
        $status = $post['status'];
        $price = "Php ".$post['price'].".00";
        $dDate = $post['dDate'];

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190,1, 'Sky Shine Express', 0, 1, "C");
        $pdf->Ln(20);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30,10, 'Order Receipt', 0, 0);
        $pdf->Cell(100,10, ': '.$receipt, 0, 0);
        $pdf->Cell(30,10, 'Delivery Date', 0, 0);
        $pdf->Cell(52,10, ': '.$dDate, 0, 1);

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(40,10, 'Package Content', 0, 0);
        $pdf->Cell(50,10, ': '.$package, 0, 1);
        $pdf->Cell(40,10, 'Courier', 0, 0);
        $pdf->Cell(52,10, ': '.$courier, 0, 1);
        $pdf->Cell(40,10, 'Mode of Payment', 0, 0);
        $pdf->Cell(52,10, ': '.$modePayment, 0, 1);

        $pdf->Line(10, 70, 200, 70);

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(110,10, "Sender's Information", 0, 0);
        $pdf->Ln(7);

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,10, 'Name', 0, 0);
        $pdf->Cell(90,10, ': '.$sName, 0, 1);
        $pdf->Cell(20,10, 'Address', 0, 0);
        $pdf->Cell(52,10, ': '.$sAddress, 0, 1);
        $pdf->Cell(20,10, 'Contact', 0, 0);
        $pdf->Cell(52,10, ': '.$sContact, 0, 1);

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(110,10, "Receiver's Information", 0, 0);
        $pdf->Ln(7);

        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20,10, 'Name', 0, 0);
        $pdf->Cell(90,10, ': '.$rName, 0, 1);
        $pdf->Cell(20,10, 'Address', 0, 0);
        $pdf->Cell(52,10, ': '.$rAddress, 0, 1);
        $pdf->Cell(20,10, 'Contact', 0, 0);
        $pdf->Cell(52,10, ': '.$rContact, 0, 1);

        $pdf->Line(10, 150, 200, 150);

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(125,3, '', 0, 0);
        $pdf->Cell(30,10, "Total Price", 0, 0);
        $pdf->Cell(20,10, ": ".$price, 0, 0);
        $pdf->Ln(7);

        $pdf->Output();
    }

    public function deleteSelected($post){
        $item = $post['checkbox'];
        foreach($item as $data){
            $sql = "DELETE FROM servicerep WHERE sID = '$data'";
            $result = $this->conn->query($sql);
        }
        header('location:../admin/admin.php');
    }
}