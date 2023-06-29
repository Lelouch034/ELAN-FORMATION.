const box = document.createElement("div");
box.classList.add("box");

for (let i = 0; i <= 4; i++) {
    let newbox = box.cloneNode();
    newbox.innerText = i;
    board.appendChild(newbox);

    newbox.addEventListener("click", function() {
        alert("hello");
    });
}
