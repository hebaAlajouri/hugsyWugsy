function updatePreview() {
    document.getElementById("preview-recipient").innerText = "For: " + document.getElementById("recipient-name").value;
    document.getElementById("preview-message").innerText = document.getElementById("gift-message").value;
    document.getElementById("preview-sender").innerText = "From: " + document.getElementById("sender-name").value;
}

function changeTemplate(imageSrc) {
    document.getElementById("card-template").src = imageSrc;
}

function changeFontStyle() {
    let selectedFont = document.getElementById("font-style").value;
    document.getElementById("preview-recipient").style.fontFamily = selectedFont;
    document.getElementById("preview-message").style.fontFamily = selectedFont;
    document.getElementById("preview-sender").style.fontFamily = selectedFont;
}

function generateGiftCard() {
    let method = document.getElementById("delivery-method").value;
    
    if (method === "Email") {
        alert("📧 Your Gift Card will be emailed!");
    } else {
        alert("🎀 Your Gift Card is ready to download!");
    }
}
function changeTemplate(templateName) {
    document.getElementById('card-template').src = '/storage/images/' + templateName;
    document.getElementById('template-selected').value = templateName;
}
