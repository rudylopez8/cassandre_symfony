import os
import sys

def generate_project_structure(output_filename="project_structure.txt", extensions=None):
    """
    Parcourt le répertoire courant, écrit l'arborescence et le contenu des 
    fichiers spécifiés dans un fichier de sortie, en ignorant le script lui-même.

    Args:
        output_filename (str): Nom du fichier où la structure sera écrite.
        extensions (list): Liste des extensions de fichiers à inclure (ex: ["php", "html"]).
    """
    if extensions is None:
        extensions = ["php", "html", "js", "css", "sql", "py"]
    
    # On s'assure que les extensions sont en minuscules et sans le point
    extensions = [ext.lower().lstrip('.') for ext in extensions]
    
    current_dir = os.getcwd()
    
    # --- Définition des éléments à exclure ---
    # 1. Le fichier de sortie lui-même
    # 2. Le script python en cours d'exécution
    # 3. Dossiers/fichiers systèmes courants à ignorer
    
    # Récupérer le nom du script en cours d'exécution
    script_name = os.path.basename(sys.argv[0])
    
    # Liste complète des éléments à exclure (noms de fichiers ou de répertoires)
    exclude_items = {
        output_filename, 
        script_name, 
        '.git', 
        '__pycache__', 
        '.DS_Store'  # Ajout pour les utilisateurs Mac
    }

    print(f"Analyse du répertoire courant : {current_dir}")
    print(f" Écriture de la structure dans : {output_filename}")
    print(f" Extensions incluses : {', '.join(extensions)}")
    print(f" Éléments exclus : {', '.join(exclude_items)}")

    try:
        with open(output_filename, 'w', encoding='utf-8') as outfile:
            outfile.write(f"--- Structure du Projet dans {current_dir} ---\n\n")

            # 1. Écrire l'arborescence des répertoires et fichiers
            outfile.write("### Arborescence du Projet ###\n")
            
            for root, dirs, files in os.walk(current_dir):
                # Modification pour exclure les répertoires spécifiés
                dirs[:] = [d for d in dirs if d not in exclude_items]
                
                # Calculer le niveau de profondeur pour l'indentation
                level = root.replace(current_dir, '').count(os.sep)
                # Utiliser l'indentation appropriée
                indent = ' ' * 4 * level
                
                # Écrire le répertoire
                if root != current_dir:
                    outfile.write(f"{indent}├── **{os.path.basename(root)}/**\n")
                
                # Écrire les fichiers du répertoire
                sub_indent = ' ' * 4 * (level + 1)
                for f in files:
                    # Exclure le fichier s'il fait partie de la liste
                    if f not in exclude_items:
                        outfile.write(f"{sub_indent}├── {f}\n")
            
            outfile.write("\n" + "="*80 + "\n\n")

            # 2. Écrire le contenu des fichiers spécifiés
            outfile.write("### Contenu des Fichiers Inclus ###\n\n")

            file_count = 0
            for root, dirs, files in os.walk(current_dir):
                # Ré-appliquer l'exclusion de répertoires pour l'étape de contenu
                dirs[:] = [d for d in dirs if d not in exclude_items]

                for f in files:
                    file_ext = os.path.splitext(f)[1].lstrip('.').lower()
                    
                    # Vérifier l'extension ET s'assurer que le fichier n'est pas dans la liste d'exclusion
                    if file_ext in extensions and f not in exclude_items:
                        filepath = os.path.join(root, f)
                        relative_path = os.path.relpath(filepath, current_dir)
                        
                        try:
                            with open(filepath, 'r', encoding='utf-8') as infile:
                                content = infile.read()
                            
                            outfile.write(f"\n--- {relative_path} ---\n")
                            outfile.write(content)
                            outfile.write("\n\n" + "-"*40 + "\n")
                            file_count += 1
                        
                        except Exception as e:
                            outfile.write(f"\n--- ERREUR DE LECTURE : {relative_path} ---\n")
                            outfile.write(f"Impossible de lire le fichier : {e}\n\n")

            print(f"✅ Opération terminée. {file_count} fichiers dont le contenu a été inclus.")

    except Exception as e:
        print(f"❌ Une erreur critique est survenue : {e}", file=sys.stderr)

# --- Exécution du Script ---
generate_project_structure(
    output_filename="project_structure.txt", 
    extensions=["php", "html", "js", "css", "sql", "py"]
)