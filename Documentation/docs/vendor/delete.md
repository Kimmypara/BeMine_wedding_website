# Delete Vendor 

Delete a Vendor.  

## Request 

<span class="box1">DELETE</span>
<span class="endpoint-box1">/vendor/delete.php?vendor_id=9</span>

---

## Description

This endpoint deletes a single vendor from the database using the provided vendor_id.

---

## Responses

### <span class="json">200 OK</span>

The request worked, so the Vendor was deleted.

```json
{
    "message": "Vendor deleted."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Vendor ID was not provided."
}
```

---

### <span class="json">401 Unauthorized</span>

Cannot delete vendor, not Authorised.

```json
{
    "message": "Unauthorized."
}
```

---

### <span class="json">403 Forbidden</span>

Cannot delete vendor if not Admin.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">404 Not Found</span>

No vendor was found with the provided vendor_id.

```json
{
    "message": "Vendor not deleted. Vendor does not exist."
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


### <span class="json">500 Server Error</span>

The server failed to delete the Category.

```json
{
    "message": "Server error."
}
``` 