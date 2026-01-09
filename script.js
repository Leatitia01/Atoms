// Example: highlight active nav link
const currentPage = window.location.pathname.split("/").pop();
const links = document.querySelectorAll(".navbar a");
links.forEach(link => {
  if (link.getAttribute("href") === currentPage) {
    link.style.fontWeight = "bold";
    link.style.color = "#ffffff";
  }
});
