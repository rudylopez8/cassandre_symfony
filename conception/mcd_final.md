@startuml
hide circle
skinparam classAttributeIconSize 0

' =========================
' REFERENTIELS & SECURITE
' =========================

class Role <<entity>> {
  role_id : int
  name : string
  description : string
}

class Permission <<entity>> {
  permission_id : int
  code : string
  description : string
}

class RolePermission <<entity>> {
  role_id : int
  permission_id : int
}

class User <<entity>> {
  user_id : int
  email : string
  password_hash : string
  first_name : string
  last_name : string
  phone : string?
  last_login : datetime?
  is_active : bool
  created_at : datetime
  updated_at : datetime
}

Role "1" -- "0..*" User : attribue
Role "1" -- "0..*" RolePermission
Permission "1" -- "0..*" RolePermission

' =========================
' ENTREPRISES & AUDITS
' =========================

class Company <<entity>> {
  company_id : int
  name : string
  siren : string
  siret : string
  sector : string?
  address : string?
  contact_email : string?
  contact_phone : string?
  created_at : datetime
  updated_at : datetime
}

class Audit <<entity>> {
  audit_id : int
  status : string
  start_date : date?
  end_date : date?
  scope : string
  notes : string
  created_at : datetime
  updated_at : datetime
}

Company "1" -- "0..*" Audit : concerne

class AuditAssignment <<entity>> {
  audit_id : int
  user_id : int
  role_on_audit : string
}

Audit "1" -- "0..*" AuditAssignment
User  "1" -- "0..*" AuditAssignment

' =========================
' DOCUMENTS
' =========================

class Document <<entity>> {
  document_id : int
  nomOriginal : string
  nomStockage : string
  chemin : string
  mimeType : string
  tailleOctets : int
  is_public : bool
  created_at : datetime
  updated_at : datetime
}

class AuditLegalDocument <<entity>> {
  legal_doc_id : int
  type : string
  status : string
  signed_at : datetime?
}

Audit "1" -- "0..*" AuditLegalDocument
AuditLegalDocument "1" -- "1" Document

' =========================
' OBSERVATIONS & RAPPORTS
' =========================

class AuditObservation <<entity>> {
  observation_id : int
  type : string
  description : text
  location : string?
  recommendation : text?
  created_at : datetime
  updated_at : datetime
}

Audit "1" -- "0..*" AuditObservation
AuditObservation "0..1" -- "1" Document : piece_jointe

class AuditReport <<entity>> {
  report_id : int
  title : string
  content : text
  status : string
  validation_date : datetime?
  created_at : datetime
  updated_at : datetime
}

Audit "1" -- "1" AuditReport
User "1" -- "0..*" AuditReport : valide

' =========================
' CERTIFICATIONS
' =========================

class Certification <<entity>> {
  certification_id : int
  name : string
  description : text
  price : decimal
  duration : int
  is_active : bool
  created_at : datetime
  updated_at : datetime
}

class CertificationSession <<entity>> {
  session_id : int
  date : datetime
  capacity : int
  created_at : datetime
}

User "1" -- "0..*" Certification : passe

class CertificationResult <<entity>> {
  result_id : int
  score : int
  status : string
  evaluation_details : json
  created_at : datetime
}

User "1" -- "0..*" Certification
User "1" -- "0..*" CertificationResult

' =========================
' FACTURATION
' =========================

class Invoice <<entity>> {
  invoice_id : int
  totalHT : decimal
  totalTTC : decimal
  status : string
  due_date : date
  payment_date : datetime?
  pdfChemin : string?
  created_at : datetime
}

class InvoiceLine <<entity>> {
  line_id : int
  libelle : string
  quantite : int
  prixUnitaireHT : decimal
  tauxTVA : decimal
  totalLigneTTC : decimal
}

Invoice "1" -- "1..*" InvoiceLine
Audit "0..1" -- "0..*" Invoice
CertificationResult "0..1" -- "0..*" Invoice
Company "1" -- "0..*" Invoice : recoit

' =========================
' ASSISTANT IA LOCAL
' =========================

class AiAssistant <<entity>> {
  assistant_id : int
  model_version : string
  last_trained : datetime
  usage_stats : json
}

class AiAssistantHistory <<entity>> {
  history_id : int
  prompt : text
  response : text
  timestamp : datetime
}

AiAssistant "1" -- "0..*" AiAssistantHistory
User "1" -- "0..*" AiAssistantHistory

@enduml
