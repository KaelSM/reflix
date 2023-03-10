
<?php
require_once("includes/header.php");

if(!isset($_GET["id"])) {
    ErrorMessage::show("no video found with selection");
}
$entityId = $_GET["id"];
$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($con, $userLoggedIn);
echo $seasonProvider->create($entity);

$categoryContainer = new CategoryContainers($con, $userLoggedIn);
echo $categoryContainer->showCategory($entity->getCategoryId(), "Recommended");
?>