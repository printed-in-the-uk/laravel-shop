# laravel-shop (work in progress)

![test](https://github.com/jskrd/laravel-shop/workflows/test/badge.svg?branch=master)

## Contents

- [Contents](#contents)
- [About](#about)
- [REST API reference](#api-endpoints)
    - [Address](#address)
        - [Create a new Address](#create-a-new-address)
        - [Retrieve an existing Address](#retrieve-an-existing-address)
        - [Update an existing Address](#update-an-existing-address)
        - [Delete an existing Address](#delete-an-existing-address)
- [Design](#design)
    - [Entity-Relationship Diagram](#entity-relationship-diagram)

## About

A package for Laravel based projects providing a shop web API.

## REST API reference

### Address

#### Create a new Address

```
POST /shop-api/addresses
{
    "name": "Lysanne Durgan",
    "street1": "86897 Ebony Park",
    "street2": "Suite 451",
    "locality": "South Antoniabury",
    "region": "South Carolina",
    "postal_code": "33547",
    "country": "US",
    "email": "lysanne.durgan@example.com",
    "phone": "1-594-781-8825"
}
```

```
201 Created
{
    "id": "5384d0d7-d372-42c2-8f41-8a0f6f3ee023",
    "name": "Lysanne Durgan",
    "street1": "86897 Ebony Park",
    "street2": "Suite 451",
    "locality": "South Antoniabury",
    "region": "South Carolina",
    "postal_code": "33547",
    "country": "US",
    "email": "lysanne.durgan@example.com",
    "phone": "1-594-781-8825",
    "created_at": "2019-02-01T03:45:27.612584Z",
    "updated_at": "2019-02-01T03:45:27.612584Z"
}
```

#### Retrieve an existing Address

```
GET /shop-api/addresses/5384d0d7-d372-42c2-8f41-8a0f6f3ee023
```

```
200 OK
{
    "id": "5384d0d7-d372-42c2-8f41-8a0f6f3ee023",
    "name": "Lysanne Durgan",
    "street1": "86897 Ebony Park",
    "street2": "Suite 451",
    "locality": "South Antoniabury",
    "region": "South Carolina",
    "postal_code": "33547",
    "country": "US",
    "email": "lysanne.durgan@example.com",
    "phone": "1-594-781-8825",
    "created_at": "2019-02-01T03:45:27.612584Z",
    "updated_at": "2019-02-01T03:45:27.612584Z"
}
```

#### Update an existing Address

```
PUT /shop-api/addresses/5384d0d7-d372-42c2-8f41-8a0f6f3ee023
{
    "name": "Elliot Moore",
    "street1": "0 Morgan Cove",
    "street2": "Flat 43",
    "locality": "South Johnshire",
    "region": "Peebleshire",
    "postal_code": "BL7 8BW",
    "country": "GB",
    "email": "elliot.moore@example.com",
    "phone": "08455 296005",
}
```

```
200 OK
{
    "id": "5384d0d7-d372-42c2-8f41-8a0f6f3ee023",
    "name": "Elliot Moore",
    "street1": "0 Morgan Cove",
    "street2": "Flat 43",
    "locality": "South Johnshire",
    "region": "Peebleshire",
    "postal_code": "BL7 8BW",
    "country": "GB",
    "email": "elliot.moore@example.com",
    "phone": "08455 296005",
    "created_at": "2019-02-01T03:45:27.612584Z",
    "updated_at": "2019-02-01T03:58:51.612584Z"
}
```

#### Delete an existing Address

```
DELETE /shop-api/addresses/5384d0d7-d372-42c2-8f41-8a0f6f3ee023
```

```
200 OK
{
    "id": "5384d0d7-d372-42c2-8f41-8a0f6f3ee023",
    "name": "Elliot Moore",
    "street1": "0 Morgan Cove",
    "street2": "Flat 43",
    "locality": "South Johnshire",
    "region": "Peebleshire",
    "postal_code": "BL7 8BW",
    "country": "GB",
    "email": "elliot.moore@example.com",
    "phone": "08455 296005",
    "created_at": "2019-02-01T03:45:27.612584Z",
    "updated_at": "2019-02-01T03:58:51.612584Z"
}
```

## Design

### Entity-Relationship Diagram

![Image of Entity-Relationship Diagram](er-diagram.png)
