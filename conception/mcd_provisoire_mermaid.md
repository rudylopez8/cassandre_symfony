erDiagram
    User ||--o{ Role : "A un rôle"
    User ||--o{ Company : "Appartient à une entreprise"
    User }o--o{ Audit : "Est auditeur"
    Role ||--o{ User : "Définit des utilisateurs"
    Company ||--o{ User : "A des employés"
    Company ||--o{ Audit : "Est auditée"
    Audit ||--o{ AuditObservation : "A des observations"
    Audit ||--|| AuditReport : "Génère un rapport"
    Audit ||--|| Invoice : "A une facture"
    AuditObservation ||--|| Document : "A un document joint"
    AuditReport ||--|| User : "Validé par un utilisateur"
    Certification ||--o{ CertificationOrder : "Est commandée"
    CertificationOrder ||--|| Invoice : "A une facture"
    Document ||--|| AuditObservation : "Joint à une observation"
    EducationalContent ||--o{ Category : "Appartient à une catégorie"
    Category ||--o{ Category : "A des sous-catégories"
    Category ||--o{ EducationalContent : "Contient du contenu"
    Invoice ||--|| Audit : "Facture un audit"
    Invoice ||--|| CertificationOrder : "Facture une commande"
    AiAssistant ||--o{ AiAssistantHistory : "A un historique"
    AiAssistantHistory }o--o{ User : "Enregistre les interactions"

    User {
        int user_id PK
        string email
        string password_hash
        string first_name
        string last_name
        string phone
        int role_id FK
        int company_id FK
        datetime last_login
        boolean is_active
        datetime created_at
        datetime updated_at
    }

    Role {
        int role_id PK
        string name
        string description
        string permissions
        datetime created_at
        datetime updated_at
    }

    Company {
        int company_id PK
        string name
        string sector
        string address
        string contact_email
        string contact_phone
        datetime created_at
        datetime updated_at
    }

    Audit {
        int audit_id PK
        int company_id FK
        int auditor_id FK
        string status
        datetime start_date
        datetime end_date
        string scope
        string notes
        datetime created_at
        datetime updated_at
    }

    AuditObservation {
        int observation_id PK
        int audit_id FK
        string type
        string description
        string location
        string recommendation
        int document_id FK
        datetime created_at
        datetime updated_at
    }

    AuditReport {
        int report_id PK
        int audit_id FK
        string title
        string content
        string status
        int validated_by FK
        datetime validation_date
        datetime created_at
        datetime updated_at
    }

    Certification {
        int certification_id PK
        string name
        string description
        decimal price
        int duration
        boolean is_active
        datetime created_at
        datetime updated_at
    }

    CertificationOrder {
        int order_id PK
        int user_id FK
        int certification_id FK
        string status
        datetime payment_date
        datetime expiration_date
        datetime created_at
        datetime updated_at
    }

    Document {
        int document_id PK
        string title
        string type
        string path
        int size
        boolean is_public
        datetime created_at
        datetime updated_at
    }

    EducationalContent {
        int content_id PK
        string title
        string description
        string content_type
        int category_id FK
        boolean is_published
        datetime created_at
        datetime updated_at
    }

    Category {
        int category_id PK
        string name
        int parent_id FK
        string description
        datetime created_at
        datetime updated_at
    }

    Invoice {
        int invoice_id PK
        int audit_id FK
        int order_id FK
        decimal amount
        string status
        datetime due_date
        datetime payment_date
        datetime created_at
        datetime updated_at
    }

    AiAssistant {
        int assistant_id PK
        string model_version
        datetime last_trained
        string usage_stats
    }

    AiAssistantHistory {
        int history_id PK
        int assistant_id FK
        int user_id FK
        string prompt
        string response
        datetime timestamp
    }