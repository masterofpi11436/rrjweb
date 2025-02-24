import re

# Sample SQL data (replace with actual data if needed)
old_sql = """
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `reset_token`, `token_expiry`, `warehouse_role`) VALUES
(72, 'Mark', 'Tuggle', 'tugglem@rrjva.org', '$2y$10$NFuC6AzJRxqZPWc7t71sIeGZWRlBfJjYs0olhLR.Cce4aojTI.MOi', 1, 'daa3ddf39f989efd54877a6e018b22eb258948308deccefcb4d86d6d71cd0cd161227fe948a8baf15afdd9868ebe94f948e9', '2025-01-21 20:50:02', 10);
"""

# Mapping of warehouse_role IDs to ENUM values
role_mapping = {
    "8": "Warehouse Supervisor",
    "9": "Supervisor",
    "10": "Requestor",
    "11": "Warehouse Technician",
    "12": "Property"
}

# Regex pattern to extract first_name, last_name, email, password, warehouse_role
pattern = re.compile(r"\(\d+, '([^']+)', '([^']+)', '([^']+)', ('[^']+'|NULL), .*?, (NULL|\d+)\)", re.DOTALL)

# Build the new SQL query
new_sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `warehouse_role`) VALUES\n"

# Extract and format rows
values = []
matches = pattern.findall(old_sql)  # Extract all matches

if not matches:
    print("No matches found. Check your input format.")

for match in matches:
    first_name, last_name, email, password, warehouse_role = match

    # Handle NULL values
    password = "NULL" if password == "NULL" else password.strip("'")  # Remove quotes if not NULL
    warehouse_role = "NULL" if warehouse_role == "NULL" else f"'{role_mapping.get(warehouse_role, 'NULL')}'"  # Map role ID to ENUM or NULL

    values.append(f"('{first_name}', '{last_name}', '{email}', '{password}', {warehouse_role})")

# Join all values with a comma
if values:
    new_sql += ",\n".join(values) + ";"
else:
    new_sql = "No valid entries found. Please check the input file."

# Output the transformed SQL
print(new_sql)
