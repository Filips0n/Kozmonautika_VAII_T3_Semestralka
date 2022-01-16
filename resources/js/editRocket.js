const editButtons = document.querySelectorAll(".rocket-edit-btn");
const rocketName = document.getElementById("rocket-edit-name");
const rocketManufacturer = document.getElementById("rocket-edit-manufacturer");
const rocketHeight = document.getElementById("rocket-edit-height");
const rocketHumanRated = document.getElementById("rocket-edit-human-rated");
const rocketPayload = document.getElementById("rocket-edit-payload");
const rocketForm = document.getElementById("rocket-edit-form");

for (let i = 0; i < editButtons.length; i++) {
    const rocketData = JSON.parse(editButtons[i].dataset.rocket);
    editButtons[i].addEventListener("click", ()=>{
        rocketForm.action=editButtons[i].dataset.url.slice(0,-1)+rocketData.id;
        rocketName.value=rocketData.name;
        rocketManufacturer.value=rocketData.manufacturer_id;
        rocketHeight.value=rocketData.height;
        rocketHumanRated.value=rocketData.human_rated ? 1 : 0;
        rocketPayload.value=rocketData.payload;
    });
}
