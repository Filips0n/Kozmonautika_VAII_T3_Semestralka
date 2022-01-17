fetch('storage/explanations.json').then(function (response){
    return response.json();
}).then(function (data2){
    displayData(data2);
}).catch(function (error){
    console.error('Something went wrong');
    console.error(error);
});

function displayData(data){
    var explButtonsWrapper = document.getElementById("explanations-buttons");
    var explContentWrapper = document.getElementById("explanations-content");
    showButtons(data, explButtonsWrapper);
    showContent(data, explContentWrapper);

    const explButtons = document.querySelectorAll(".explanation-button");
    const explRow = document.querySelectorAll(".explanation-row");
    for (let i = 0; i < explButtons.length; i++) {
        explButtons[i].addEventListener("click", ()=>{
            explRow.forEach((element) => { 
                if(element.id == explButtons[i].id || explButtons[i].id == 'all'){
                    element.style.display = '';
                } else {
                    element.style.display = 'none';  
                }
            });
        });
    }
}

function showButtons(data, explButtonsWrapper){
    var buttonLetters = [];
    var letter;
    for (let i = 0; i < data.length; i++) {
        letter = data[i].title.slice(0,1);
        if(!buttonLetters.includes(letter)){
            buttonLetters.push(letter);
        }
    }

    explButtonsWrapper.innerHTML += `<a class="explanation-button" id="all" style="color: inherit;text-decoration: none;">
                                        <button type="button" class="btn btn-info m-1">Všetky</button></a>`;
    buttonLetters.forEach((element) => { 
        let row = `<a class="explanation-button" id="${element}" style="color: inherit;text-decoration: none;">
                        <button type="button" class="btn btn-primary m-1">${element}</button></a>`;
        explButtonsWrapper.innerHTML += row;
    });
}

function showContent(data, explContentWrapper){
    for (let i = 0; i < data.length; i++) {
        let row = `<ul class="list-group list-group-horizontal m-1 explanation-row" id="${data[i].title.slice(0,1)}">
                        <li class="list-group-item">${data[i].title}</li>
                        <li class="list-group-item flex-fill">${data[i].text}</li>
                    </ul>`;
      explContentWrapper.innerHTML += row;
    }
}


