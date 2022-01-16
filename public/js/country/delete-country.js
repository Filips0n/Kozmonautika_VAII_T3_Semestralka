const deleteCountryBtns = document.querySelectorAll(".delete-country-btn");
const buttonDeleteCountry = document.getElementById("button-delete-country");
console.log(deleteCountryBtns);
for(let i = 0; i < deleteCountryBtns.length; i++){
    const countryDeleteData = deleteCountryBtns[i].dataset.countrydelete;
    deleteCountryBtns[i].addEventListener("click", ()=>{
        console.log(buttonDeleteCountry.innerHTML);
        buttonDeleteCountry.innerHTML.id = countryDeleteData;
    });
}