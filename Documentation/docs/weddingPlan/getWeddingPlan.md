# Get Wedding Plans

Get a list of all Wedding Plans. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/wedding_plan/read.php</span>

---

## Description

This endpoint returns all Wedding Plans stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
     
        {
            "wedding_plan_id": 6,
            "user_id": 3,
            "user_nickname": "Kate",
            "partner_nickname": "Borg",
            "wedding_date": "2026-01-02",
            "guest_count": 400,
            "budget": "70000.00"
        },
        {
            "wedding_plan_id": 20,
            "user_id": 22,
            "user_nickname": "Kim",
            "partner_nickname": "Tim",
            "wedding_date": "2026-10-18",
            "guest_count": 100,
            "budget": "25000.00"
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Wedding Plans were found.

```json
{
    "message": "Wedding Plans not found."
}
```