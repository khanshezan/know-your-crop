const form = document.getElementById('cropForm');
const loader = document.getElementById('loader');
const modal = document.getElementById('resultModal');
const resultDetails = document.getElementById('resultDetails');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const state = document.getElementById('state').value;
    const district = document.getElementById('district').value;

    if (!state || !district) {
        alert("Please select both State and District!");
        return;
    }

    loader.style.display = "block";
    const startTime = Date.now();

    fetch("map.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "district=" + encodeURIComponent(district)
    })
    .then(res => res.json())
    .then(data => {
        const elapsed = Date.now() - startTime;
        const minDelay = 1200; // 1.2 seconds
        const remaining = Math.max(0, minDelay - elapsed);

        setTimeout(() => {
            loader.style.display = "none";

            if (data.error) {
                resultDetails.innerHTML = `<p>${data.error}</p>`;
            } else {
                resultDetails.innerHTML = `
                  🌍 <b>District:</b> ${data.district} <br>
                  ☀️ <b>Climate:</b> ${data.climate} <br>
                  🌱 <b>Soil Type:</b> ${data.soil} <br>
                  🌾 <b>Major Crops:</b> ${data.major} <br>
                  ✅ <b>Recommended Crops:</b> ${data.recommend}
                `;
            }
            modal.style.display = "flex";
        }, remaining);
    })
    .catch(err => {
        loader.style.display = "none";
        resultDetails.innerHTML = `<p>Error fetching data.</p>`;
        modal.style.display = "flex";
    });
});

function closeModal() {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Mobile nav toggle
const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');
hamMenu.addEventListener('click', () =>{
    hamMenu.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
});
