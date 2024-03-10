<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbrestore");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomeParco = $_POST["nomeparco"];
        $sql = "SELECT * FROM specie INNER JOIN parchi ON parchi.id_Parco = specie.Parco WHERE parchi.nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s',$nomeParco);
        $stmt->execute();
        $result = $stmt->get_result();
        $datispecie = [];
        while($row = $result->fetch_assoc()){
            $imageInfo = getimagesizefromstring($row['ImgSpecie']);
            $imageType = $imageInfo['mime'];
            $base64img = base64_encode($row['ImgSpecie']);
            $datispecie[]=[
                'IdBio'=>$row['Id_Bio'],
                'NomeScientifico' => $row['NomeScientifico'],
                'Tipo' => $row['Tipo'],
                'Img' => $base64img
            ];
            
            
        }
        $_SESSION['specie'] = $datispecie;
        $stmt->close();
        $conn->close();
        header("Location: SceltaSpecie.php");
    
} else {
    // Gestisci il caso in cui la richiesta non sia di tipo POST
    echo "Errore: Metodo di richiesta non valido.";
    $conn->close();
}
?>