# Get Wedding Plan Tasks by Wedding Plan ID

Get a wedding plan tasks by wedding_plan_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/wedding_plan_task/readByWeddingPlanId.php?wedding_plan_id=17</span>

---

## Description

This endpoint returns all wedding plan tasks from the database using the provided wedding_plan_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "wedding_plan_task_id": 264,
            "wedding_plan_id": 17,
            "category_id": 27,
            "is_selected": 1,
            "is_completed": 1,
            "completed_at": "2026-05-24 12:01:43",
            "category_name": "Balloon Decorations"
        },
        {
            "wedding_plan_task_id": 265,
            "wedding_plan_id": 17,
            "category_id": 19,
            "is_selected": 1,
            "is_completed": 1,
            "completed_at": "2026-05-24 12:01:43",
            "category_name": "Beverage Services"
        },
        {
            "wedding_plan_task_id": 222,
            "wedding_plan_id": 17,
            "category_id": 9,
            "is_selected": 1,
            "is_completed": 1,
            "completed_at": "2026-05-24 12:01:43",
            "category_name": "Bridal Wear"
        }
    ]
}
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

No wedding plan tasks were found with the provided wedding_plan_id.

```json
{
    "message": "No tasks found."
}
```