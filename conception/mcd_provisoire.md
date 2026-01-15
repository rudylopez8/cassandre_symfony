| **Entité**          | **Attributs**                                                                 | **Relations**                                                                 |
|---------------------|-----------------------------------------------------------------------------|-------------------------------------------------------------------------------|
| **User**            | `user_id` (PK), `email`, `password_hash`, `first_name`, `last_name`, `phone`, `role_id` (FK), `company_id` (FK), `last_login`, `is_active`, `created_at`, `updated_at` | - A un rôle (N:1) <br> - Appartient à une entreprise (N:1) <br> - Est auditeur (N:N via `audit_assignments`) |
| **Role**            | `role_id` (PK), `name`, `description`, `permissions`, `created_at`, `updated_at` | - Définit des utilisateurs (1:N) |
| **Company**         | `company_id` (PK), `name`, `sector`, `address`, `contact_email`, `contact_phone`, `created_at`, `updated_at` | - A des employés (1:N via `company_users`) <br> - Est auditée (1:N) |
| **Audit**           | `audit_id` (PK), `company_id` (FK), `auditor_id` (FK), `status`, `start_date`, `end_date`, `scope`, `notes`, `created_at`, `updated_at` | - A des observations (1:N) <br> - Génère un rapport (1:1) <br> - A une facture (1:1) |
| **AuditObservation**| `observation_id` (PK), `audit_id` (FK), `type`, `description`, `location`, `recommendation`, `document_id` (FK), `created_at`, `updated_at` | - A un document joint (1:1) |
| **AuditReport**     | `report_id` (PK), `audit_id` (FK), `title`, `content`, `status`, `validated_by` (FK), `validation_date`, `created_at`, `updated_at` | - Validé par un utilisateur (1:1) |
| **Certification**   | `certification_id` (PK), `name`, `description`, `price`, `duration`, `is_active`, `created_at`, `updated_at` | - Est commandée (1:N) |
| **CertificationOrder** | `order_id` (PK), `user_id` (FK), `certification_id` (FK), `status`, `payment_date`, `expiration_date`, `created_at`, `updated_at` | - A une facture (1:1) |
| **Document**        | `document_id` (PK), `title`, `type`, `path`, `size`, `is_public`, `created_at`, `updated_at` | - Joint à une observation (1:1) |
| **EducationalContent** | `content_id` (PK), `title`, `description`, `content_type`, `category_id` (FK), `is_published`, `created_at`, `updated_at` | - Appartient à une catégorie (N:1) |
| **Category**        | `category_id` (PK), `name`, `parent_id` (FK), `description`, `created_at`, `updated_at` | - A des sous-catégories (1:N) <br> - Contient du contenu (1:N) |
| **Invoice**         | `invoice_id` (PK), `audit_id` (FK), `order_id` (FK), `amount`, `status`, `due_date`, `payment_date`, `created_at`, `updated_at` | - Facture un audit ou une commande (1:1) |
| **AiAssistant**     | `assistant_id` (PK), `model_version`, `last_trained`, `usage_stats` | - A un historique (1:N) |
| **AiAssistantHistory** | `history_id` (PK), `assistant_id` (FK), `user_id` (FK), `prompt`, `response`, `timestamp` | - Enregistre les interactions (N:N via `user_id`) |
