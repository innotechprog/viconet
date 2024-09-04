// getting all required elements

const searchWrapper = document.querySelector(".s_tal");
const inputBox = searchWrapper.querySelector(".s_input");
const suggBox = searchWrapper.querySelector(".autocomplete-search");
//const icon = searchWrapper.querySelector(".icon");
//let linkTag = searchWrapper.querySelector("a");
//let webLink;

// if user press any key and release
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user entered data
    let emptyArray = [];
    if(userData){ 
        
      emptyArray =  Array.from(new Set(suggestions.filter((data)=>{
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        })));
      
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            return data = '<li>'+data+'</li>'; });

        searchWrapper.classList.add("sactive"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick","select(this)");
        }
    }else{
        searchWrapper.classList.remove("sactive"); //hide autocomplete box
    }
}

function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    searchWrapper.classList.remove("sactive");
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value;
        listData = '<li>'+userValue+'</li>';
    }else{
      listData = list.join('');
    }
    suggBox.innerHTML = listData;
}
window.onclick = function(e){
   searchWrapper.classList.remove("sactive"); //hide autocomplete box 
}
 