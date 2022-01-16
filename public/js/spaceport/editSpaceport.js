const editSpaceportButtons = document.querySelectorAll(".spaceport-edit-btn");
const spaceportName = document.getElementById("spaceport-edit-name");
const spaceportCountry = document.getElementById("spaceport-edit-country-id");
const spaceportLaunches = document.getElementById("spaceport-edit-launches");
const spaceportActiveFrom = document.getElementById("spaceport-edit-active-from");
const spaceportLatitude = document.getElementById("spaceport-edit-latitude");
const spaceportLongitude = document.getElementById("spaceport-edit-longitude");
const spaceportForm = document.getElementById("spaceport-edit-form");

for (let i = 0; i < editSpaceportButtons.length; i++) {
    const spaceportData = JSON.parse(editSpaceportButtons[i].dataset.spaceport);
    editSpaceportButtons[i].addEventListener("click", ()=>{
        spaceportForm.action=editSpaceportButtons[i].dataset.url.slice(0,-1)+spaceportData.id;
        spaceportName.value=spaceportData.name;
        spaceportCountry.value=spaceportData.country_id;
        spaceportLaunches.value=spaceportData.launches;
        spaceportActiveFrom.value=spaceportData.active_from;
        spaceportLatitude.value=spaceportData.latitude;
        spaceportLongitude.value=spaceportData.longitude;
    });
}