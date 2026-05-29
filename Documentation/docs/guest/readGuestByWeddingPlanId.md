# Get Guest by Wedding Plan ID

Get a Guest by wedding_plan_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/guest/readByWeddingPlan.php?wedding_plan_id=17</span>

---

## Description

This endpoint returns all guests from the database using the provided wedding_plan_id.

---

## Response

### <span class="json">200 OK</span>

```json
[
    {
        "guest_id": 7,
        "guest_name": "Keith",
        "guest_surname": "Borg",
        "guest_email": "kborg@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Family of the Groom"
    },
    {
        "guest_id": 9,
        "guest_name": "Kim",
        "guest_surname": "Farrugia",
        "guest_email": "kfarrugia@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Friends"
    },
    {
        "guest_id": 10,
        "guest_name": "Martina",
        "guest_surname": "Vella",
        "guest_email": "mvella@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Work Friends"
    },
    {
        "guest_id": 5,
        "guest_name": "Mary",
        "guest_surname": "Cassar",
        "guest_email": "mcassar@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Family of the Bride"
    },
    {
        "guest_id": 6,
        "guest_name": "Sandra",
        "guest_surname": "Hili",
        "guest_email": "shili@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Family of the Bride"
    },
    {
        "guest_id": 8,
        "guest_name": "Tom",
        "guest_surname": "Vella",
        "guest_email": "tvella@gmail.com",
        "rsvp_status": "pending",
        "guest_category": "Family of the Groom"
    }
]
```

---
### <span class="json">400 Bad request</span>

The wedding_plan_id is missing.

```json
{
    "message": "Missing wedding_plan_id."
}
```
---
### <span class="json">404 Not Found</span>

No guests were found with the provided wedding_plan_id.

```json
{
    "message": "No guests found."
}
```