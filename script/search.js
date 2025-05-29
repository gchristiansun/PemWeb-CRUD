document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const tableBody = document.getElementById("mahasiswaTable");

  searchInput.addEventListener("keyup", () => {
    const keyword = searchInput.value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../page/index.php?ajax=search&keyword=${encodeURIComponent(keyword)}`, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        tableBody.innerHTML = xhr.responseText;
      }
    };

    xhr.send();
  });
});
