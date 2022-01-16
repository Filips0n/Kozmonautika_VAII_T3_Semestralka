const deleteSpaceportBtns = document.querySelectorAll(".delete-spaceport-btn");
const buttonDeleteSpaceport = document.getElementById("button-delete-spaceport");
for(let i = 0; i < deleteSpaceportBtns.length; i++){
    const spaceportDeleteData = deleteSpaceportBtns[i].dataset.spaceportdelete;
    deleteSpaceportBtns[i].addEventListener("click", ()=>{
        buttonDeleteSpaceport.href = "destroySpaceport/"+ spaceportDeleteData;
    });
}