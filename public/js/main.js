// js/main.js – Exemple d’ajout d’une observation via le modal IA
document.addEventListener('DOMContentLoaded', () => {
  const btnAdd = document.querySelector('#aiModal .btn-primary');
  const textarea = document.querySelector('#aiModal textarea');

  btnAdd?.addEventListener('click', () => {
    const content = `
    <p><strong>Observation IA :</strong></p>
    <ul>
      <li>Vérifier l'authentification MFA.</li>
      <li>Examiner la segmentation réseau.</li>
    </ul>
    `;
    // Simuler l’ajout dans la section observations
    const obsSection = document.querySelector('#observations tbody');
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>Security</td>
      <td>IA suggère de vérifier la MFA.</td>
      <td><span class="badge bg-info text-dark">Moyen</span></td>
      <td>Valider la configuration MFA.</td>
    `;
    obsSection?.appendChild(row);
    // Fermer modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('aiModal'));
    modal?.hide();
  });
})