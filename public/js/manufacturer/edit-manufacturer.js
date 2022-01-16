const newManuBtn = document.getElementById("manufacturer-new-button"); 
const manuTbody = document.getElementById("manufacturer-tbody"); 
const manuCloseNewBtn = document.getElementById("manufacturer-close-new");
const newManuTr = document.getElementById("manufacturer-new-tr");
const newManuTrEdit = document.getElementById("manufacturer-new-tr-edit");
newManuBtn.addEventListener("click", () => {
    newManuTr.style.display = 'none'; 
    newManuTrEdit.style.display = "";

});

manuCloseNewBtn.addEventListener("click", ()=>{
    newManuTr.style.display = ''; 
    newManuTrEdit.style.display = 'none';
});

//////////////////////////////////////////// Delete
const deleteManufacturerBtns = document.querySelectorAll(".delete-manufacturer-btn");
const buttonDeleteManufacturer = document.getElementById("button-delete-manufacturer");
for(let i = 0; i < deleteManufacturerBtns.length; i++){
    const manufacturerDeleteData = deleteManufacturerBtns[i].dataset.manufacturerdelete;
    deleteManufacturerBtns[i].addEventListener("click", ()=>{
        buttonDeleteManufacturer.href = "destroyManufacturer/"+ manufacturerDeleteData;
    });
}
/////////////////////////////////////////// Edit
let editing = false;
const countryTdInputs = document.querySelectorAll(".manu-country-input");
const nameTdInputs = document.querySelectorAll(".manu-name-input");

let previousName;
let previousCountry;

const editButtons = document.querySelectorAll(".manu-edit-btn");
for (let i = 0; i < editButtons.length; i++) {
    const manufacturerEditData = editButtons[i].dataset.manufactureredit;
    editButtons[i].addEventListener("click", ()=>{
        if(!editing){
            editing = true;
            const countryFormTd = document.getElementById(manufacturerEditData+"-form");
            const nameFormTd = document.getElementById(manufacturerEditData+"-form1");
            const countryInputTd = document.getElementById(manufacturerEditData+"-country");
            const nameInputTd = document.getElementById(manufacturerEditData+"-name");
            const xButton = document.getElementById(manufacturerEditData+"-x");
            const checkButton = document.getElementById(manufacturerEditData+"-check");
            const deleteButton = document.getElementById(manufacturerEditData);
            const updateButton = document.getElementById(manufacturerEditData+"-update");

            previousCountry = countryInputTd.innerHTML.slice(0,1);
            previousName = nameInputTd.innerHTML;

            document.getElementById(manufacturerEditData+"-country_id_input").value = previousCountry;
            document.getElementById(manufacturerEditData+"-name_input").value = previousName;

            document.getElementById(manufacturerEditData+"-manufacturer-edit-form").action=editButtons[i].dataset.url.slice(0,-1)+manufacturerEditData;
            nameFormTd.style.display = '';
            countryFormTd.style.display = '';
            countryInputTd.style.display = 'none';
            nameInputTd.style.display = 'none';

            xButton.style.display = '';
            checkButton.style.display = '';
            deleteButton.style.display = 'none';
            updateButton.style.display = 'none';
        }
    });
}
///////////////////////////////////CLOSE
const closeButtons = document.querySelectorAll(".manu-close-btn");
for(let i = 0; i < closeButtons.length; i++){
    const manufacturerEditData = closeButtons[i].dataset.manufactureredit;
    closeButtons[i].addEventListener("click", () => {
        const countryFormTd = document.getElementById(manufacturerEditData+"-form");
        const nameFormTd = document.getElementById(manufacturerEditData+"-form1");
        const countryInputTd = document.getElementById(manufacturerEditData+"-country");
        const nameInputTd = document.getElementById(manufacturerEditData+"-name");
        const xButton = document.getElementById(manufacturerEditData+"-x");
        const checkButton = document.getElementById(manufacturerEditData+"-check");
        const deleteButton = document.getElementById(manufacturerEditData);
        const updateButton = document.getElementById(manufacturerEditData+"-update");

        nameFormTd.style.display = 'none';
        countryFormTd.style.display = 'none';
        countryInputTd.style.display = '';
        nameInputTd.style.display = '';

        xButton.style.display = 'none';
        checkButton.style.display = 'none';
        deleteButton.style.display = '';
        updateButton.style.display = '';

        document.getElementById(manufacturerEditData+"-country_id_input").value = previousCountry;
        document.getElementById(manufacturerEditData+"-name_input").value = previousName;
        editing = false;
    });
}
/////////////////////////////////////SAVE
const doneButtons = document.querySelectorAll(".manu-done-btn");
for(let i = 0; i < doneButtons.length; i++){
    const manufacturerEditData = doneButtons[i].dataset.manufactureredit;
    doneButtons[i].addEventListener("click", () => {
        
        const countryFormTd = document.getElementById(manufacturerEditData+"-form");
        const nameFormTd = document.getElementById(manufacturerEditData+"-form1");
        const countryInputTd = document.getElementById(manufacturerEditData+"-country");
        const nameInputTd = document.getElementById(manufacturerEditData+"-name");
        const xButton = document.getElementById(manufacturerEditData+"-x");
        const checkButton = document.getElementById(manufacturerEditData+"-check");
        const deleteButton = document.getElementById(manufacturerEditData);
        const updateButton = document.getElementById(manufacturerEditData+"-update");

        nameFormTd.style.display = 'none';
        countryFormTd.style.display = 'none';
        countryInputTd.style.display = '';
        nameInputTd.style.display = '';

        xButton.style.display = 'none';
        checkButton.style.display = 'none';
        deleteButton.style.display = '';
        updateButton.style.display = '';

        editing = false;
    });
}
