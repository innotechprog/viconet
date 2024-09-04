$(document).ready(function(){
  $('#tal_search').click(function(){
    $('.pagination-buttonss').hide();
    $.ajax({
      url:"global_search2.php",
      method:"POST",
      data:$('#myForm3').serialize(),
      success:function(data)
      {
     //alert("added");
        //$('#search_return').html(data);
        var text = data;

        let searchVal = document.getElementById("inputBox").value;
        let myArray = searchVal.split(",");

        if(searchVal !== "" && searchVal !== "div" && searchVal !== "data" && searchVal !== "p"){
          //Hidden below 
            //const regExp = new RegExp(`(${myArray.join('|')})`, 'g'); 
            //const result = text.replace(regExp, match => `<mark style='background:#E4186D;color:#fff'>${match}</mark>`);
            $('#search_return').html(text);
let items= $(".box");
let numItems= items.length;
var pageLim = 10;
var index = 1;
var totNumPages = Math.ceil(numItems / pageLim);
var currentPage;
//$(".candidatess .box").hide().slice((currentPage - 1),currentPage * pageLim).show();
const pageNumbers = (total, max, current) => {
  const half = Math.floor(max / 2);
  let to = max;
  
  if(current + half >= total) {
    to = total;
  } else if(current > half) {
    to = current + half ;
  }
  
  let from = Math.max(to - max, 0);

  return Array.from({length: Math.min(total, max)}, (_, i) => (i + 1) + from);
}

function PaginationButton(totalPages, maxPagesVisible = 10, currentPage = 1) {
  let pages = pageNumbers(totalPages, maxPagesVisible, currentPage);
  let currentPageBtn = null;
  const buttons = new Map();
  const disabled = {
    start: () => pages[0] === 1,
    prev: () => currentPage === 1 || currentPage > totalPages,
    end: () => pages.slice(-1)[0] === totalPages,
    next: () => currentPage >= totalPages
  }
  const frag = document.createDocumentFragment();
  const paginationButtonContainer = document.getElementById("pagin");
  paginationButtonContainer.className = 'pagination-buttonss';
  
  const createAndSetupButton = (label = '', cls = '', disabled = false, handleClick) => {
    const buttonElement = document.createElement('button');
    buttonElement.textContent = label;
    buttonElement.className = `page-btn ${cls}`;
    buttonElement.disabled = disabled;
    buttonElement.addEventListener('click', e => {
      handleClick(e);
      this.update();
      paginationButtonContainer.value = currentPage;
      paginationButtonContainer.dispatchEvent(new CustomEvent('change', {detail: {currentPageBtn}}));
    });
    
    return buttonElement;
  }
  
  const onPageButtonClick = e => currentPage = Number(e.currentTarget.textContent);
  
  const onPageButtonUpdate = index => (btn) => {
    btn.textContent = pages[index];
    
    if(pages[index] === currentPage) {
      currentPageBtn.classList.remove('active');
      btn.classList.add('active');
      currentPageBtn = btn;
      currentPageBtn.focus();
    }
  };
  
  buttons.set(
    createAndSetupButton('<<', 'start-page', disabled.start(), () => currentPage = 1),
    (btn) => btn.disabled = disabled.start()
  )
  
  buttons.set(
    createAndSetupButton('<', 'prev-page', disabled.prev(), () => currentPage -= 1),
    (btn) => btn.disabled = disabled.prev()
  )
  
  pages.map((pageNumber, index) => {
    const isCurrentPage = currentPage === pageNumber;
    const button = createAndSetupButton(
      pageNumber, isCurrentPage ? 'active' : '', false, onPageButtonClick
    );
    
    if(isCurrentPage) {
      currentPageBtn = button;
    }
    
    buttons.set(button, onPageButtonUpdate(index));
  });
  
  buttons.set(
    createAndSetupButton('>', 'next-page', disabled.next(), () => currentPage += 1),
    (btn) => btn.disabled = disabled.next()
  )
  
  buttons.set(
    createAndSetupButton('>>', 'end-page', disabled.end(), () => currentPage = totalPages),
    (btn) => btn.disabled = disabled.end()
  )
  
  buttons.forEach((_, btn) => frag.appendChild(btn));
  paginationButtonContainer.appendChild(frag);
  
  this.render = (container = document.body) => {
    container.appendChild(paginationButtonContainer);
  }
  
  this.update = (newPageNumber = currentPage) => {
    currentPage = newPageNumber;
    pages = pageNumbers(totalPages, maxPagesVisible, currentPage);
    buttons.forEach((updateButton, btn) => updateButton(btn));
  }
  
  this.onChange = (handler) => {
    paginationButtonContainer.addEventListener('change', handler);
  }
}

const paginationButtons = new PaginationButton(totNumPages, 5);

function showCandidates(index){
  for(let x = 0;x < numItems;x++){
    //console.log(items[x]);
    items[x].classList.remove("show");
    items[x].classList.add("hide");
    if(x >= index*pageLim - pageLim && x < index*pageLim){
      items[x].classList.add("show");
    }
  }
}

showCandidates(index);
paginationButtons.onChange(e => {
  window.scrollTo(0, 0);
showCandidates(e.target.value);
//console.log('-- changed', e.target.value);
});
        }
      }
    });
  });
});