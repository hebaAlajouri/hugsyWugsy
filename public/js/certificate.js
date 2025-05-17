function updateCertificate() {
    const ownerName = document.getElementById('owner-name-input').value;
    const bearName = document.getElementById('bear-name-input').value;
    const adoptionDate = document.getElementById('adoption-date-input').value || 'March 14, 2025'; // Default date if none provided

    // Update the certificate content
    document.getElementById('owner-name').innerHTML = `<strong>${ownerName}</strong>`;
    document.getElementById('bear-name').innerHTML = `<strong>${bearName}</strong>`;
    document.getElementById('adoption-date').innerHTML = `on <strong>${adoptionDate}</strong>`;
}
