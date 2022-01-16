const deleteRocketBtns = document.querySelectorAll(".delete-rocket-btn");
const buttonDeleteRocket = document.getElementById("button-delete-rocket");
for(let i = 0; i < deleteRocketBtns.length; i++){
    const rocketDeleteData = deleteRocketBtns[i].dataset.rocketdelete;
    deleteRocketBtns[i].addEventListener("click", ()=>{
        buttonDeleteRocket.href = "destroy/"+ rocketDeleteData;
    });
}