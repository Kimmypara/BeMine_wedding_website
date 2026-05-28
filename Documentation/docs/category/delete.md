# Delete Category 

Delete a Category.  

## Request 

<span class="box1">DELETE</span>
<span class="endpoint-box1">/category/delete.php?category_id=25</span>

---

## Description

This endpoint deletes a single category from the database using the provided category_id.

---

## Responses

### <span class="json">200 OK</span>

The request worked, so the Category was deleted.

```json
{
    "message": "Category deleted."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Category ID was not provided."
}
```

---

### <span class="json">401 Unauthorized</span>

Cannot delete category, not Authorised.

```json
{
    "message": "Unauthorized."
}
```

---

### <span class="json">403 Forbidden</span>

Cannot delete category if not Admin.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">404 Not Found</span>

No category was found with the provided category_id.
```json
{
    "message": "Category not deleted. Category does not exist."
}
```

---

### <span class="json">405 Method Not Allowed</span>

Incorrect Request Method used.

```json
{
    "message": "Incorrect Request Method used."
}
```

---

### <span class="json">409 Conflict</span>

The Category is linked to an existing wedding plan.

```json
{
    "message": "Category cannot be deleted because it is linked to existing wedding plans."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to delete the Category.

```json
{
    "message": "Server error."
}
``` 