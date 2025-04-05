document.addEventListener("DOMContentLoaded", function () {
    let mapObject = document.getElementById("mongolia-map");

    mapObject.addEventListener("load", function () {
        let svgDoc = mapObject.contentDocument;
        if (!svgDoc) return;  // Ensure SVG is loaded

        let provinces = svgDoc.querySelectorAll(".province");

        provinces.forEach(province => {
            province.addEventListener("mouseover", () => {
                province.style.fill = "#ff6600";
                province.style.transform = "scale(1.1)";
            });

            province.addEventListener("mouseout", () => {
                province.style.fill = "#1a1a1a";
                province.style.transform = "scale(1)";
            });

            province.addEventListener("click", () => {
                let gamePage = province.getAttribute("data-link");
                if (gamePage) {
                    redirectToGame(gamePage);
                }
            });
        });
    });
});

function redirectToGame(gamePage) {
    const confirmation = confirm("Та энэ тоглоомыг эхлүүлэхийг хүсч байна уу?");
    if (confirmation) {
        window.location.href = gamePage;
    }
}