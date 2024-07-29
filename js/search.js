function filterProgrammes() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const programmeCards = document.getElementsByClassName('programme_card');
    const noResults = document.getElementById('noResults');
    let hasResults = false;
  
    for (let i = 0; i < programmeCards.length; i++) {
      const programmeTitle = programmeCards[i].querySelector('.programme_details h4').innerText.toLowerCase();
      if (programmeTitle.includes(searchInput)) {
        programmeCards[i].style.display = "";
        hasResults = true;
      } else {
        programmeCards[i].style.display = "none";
      }
    }
  
    if (hasResults) {
      noResults.style.display = "none";
    } else {
      noResults.style.display = "block";
    }
  }
  