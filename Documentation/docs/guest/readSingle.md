# Get Single Guest

Get a single guest by guest_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/guest/readSingle.php?guest_id=6</span>

---

## Description

This endpoint returns a single guest from the database using the provided guest_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "guest_id": 6,
    "wedding_plan_id": 17,
    "guest_email": "shili@gmail.com",
    "guest_name": "Sandra",
    "guest_surname": "Hili",
    "rsvp_status": "pending",
    "guest_category": "Family of the Bride"
}
```

---
### <span class="json">400 Bad request</span>

The guest_id is missing.

```json
{
    "message": "Missing Guest Id."
}
```
---
### <span class="json">404 Not Found</span>

No guest was found with the provided guest_id.

```json
{
    "message": "Guest not found."
}
```