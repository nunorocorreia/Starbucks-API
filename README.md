## Starbucks Inventory Management API

A REST API for managing a Starbucks coffee shop inventory system.

### Base URL
`/api/v1`

### Overview
This API allows you to:
- Manage drink categories, products, and extras
- Check product availability
- Place orders with customizable extras
- Process payments and calculate change

### Available Endpoints

#### Categories
- **GET** `/categories` - Get all categories
  - Optional query parameter: `include=drinks` to include drinks in response
- **GET** `/categories/{id}` - Get a specific category by ID
  - Optional query parameter: `include=drinks` to include drinks in response
- **POST** `/categories` - Create a new category
- **PUT** `/categories/{id}` - Update a category
- **DELETE** `/categories/{id}` - Delete a category

#### Drinks
- **GET** `/drinks` - Get all drinks (paginated)
  - Filters:
    - `name` - Filter by drink name (supports wildcard `*`)
  - Sorting:
    - Supports sorting by: `name`, `price`, `stock`, `createdAt`, `updatedAt`
- **GET** `/drinks/{id}` - Get a specific drink by ID
- **POST** `/drinks` - Create a new drink
- **PUT** `/drinks/{id}` - Update a drink
- **DELETE** `/drinks/{id}` - Delete a drink

#### Extras
- **GET** `/extras` - Get all available extras
- **GET** `/extras/{id}` - Get a specific extra by ID
- **POST** `/extras` - Create a new extra
- **PUT** `/extras/{id}` - Update an extra
- **DELETE** `/extras/{id}` - Delete an extra

#### Orders
- **POST** `/orders` - Place a new order
  - Required fields:
    - `drink_id` - ID of the drink being ordered
    - `extras` - Array of extra IDs to add to the drink (optional)
    - `payment_amount` - Amount of money provided by the customer
  - Returns:
    - Order confirmation with total price and change
    - Error message if payment insufficient or drink out of stock

### Response Format
Responses follow a JSON API-like specification:

#### Category Response Example
```json
{
  "type": "category",
  "id": 1,
  "attributes": {
    "name": "Coffee"
  },
  "includes": [...],  // When drinks are included
  "links": {
    "self": "/api/v1/categories/1"
  }
}
```

#### Drink Response Example
```json
{
  "type": "drink",
  "id": 1,
  "attributes": {
    "name": "Latte",
    "price": 4.99,
    "stock": 100
  },
  "relationships": {
    "category": {
      "data": {
        "type": "category",
        "id": 1,
        "name": "Coffee"
      }
    },
    "links": {
      "self": "/api/v1/categories/1"
    }
  },
  "links": {
    "self": "/api/v1/drinks/1"
  }
}
```

#### Extra Response Example
```json
{
  "type": "extra",
  "id": 1,
  "attributes": {
    "name": "Whipped Cream",
    "price": 0.50
  },
  "links": {
    "self": "/api/v1/extras/1"
  }
}
```

#### Order Response Example
```json
{
  "type": "order",
  "id": 1,
  "attributes": {
    "drink": {
      "id": 1,
      "name": "Latte",
      "price": 4.99
    },
    "extras": [
      {
        "id": 1,
        "name": "Whipped Cream",
        "price": 0.50
      },
      {
        "id": 3,
        "name": "Syrup",
        "price": 0.75
      }
    ],
    "total_price": 6.24,
    "payment_amount": 10.00,
    "change": 3.76,
    "status": "completed"
  },
  "links": {
    "self": "/api/v1/orders/1"
  }
}
```

#### Error Response Example
```json
{
  "error": {
    "code": 400,
    "message": "Insufficient funds. Required: €6.24, Provided: €5.00"
  }
}
```

### Example Use Cases

1. **Browse Menu**:
   - GET `/api/v1/categories?include=drinks` to view all categories with their drinks

2. **Order a Customized Drink**:
   - GET `/api/v1/extras` to see available extras
   - POST `/api/v1/orders` with drink_id, extras array, and payment_amount

3. **Check Stock**:
   - GET `/api/v1/drinks/{id}` to see if a specific drink is in stock before ordering
