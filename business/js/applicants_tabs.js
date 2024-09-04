function openTab(event, tabName) {
    const tabContents = document.getElementsByClassName("tab-content");
    for (const tabContent of tabContents) {
        tabContent.classList.remove("active");
    }

    const tabs = document.getElementsByClassName("tab-button");
    for (const tab of tabs) {
        tab.classList.remove("active");
    }

    document.getElementById(tabName).classList.add("active");
    event.currentTarget.classList.add("active");
}

// Open the first tab by default
document.getElementById("tab1").classList.add("active");
document.querySelector(".tab-button").classList.add("active");
