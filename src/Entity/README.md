# Database Schema

<img src="/documentation/schema.png">

**For any predefined values for entities, see [/migrations](/migrations/).**

In the Symfony, the user entity is the Inventor. This entity is what handles the current session, registration and logins, and other core functions like user roles. All other entities are created by users or are representations of business logic.

The following entities are currently implented:
- BusinessType
- Category
- DateTypes
- Dates
- File
- Inventor
- Language
- Localization
- Patent
- PersonType
- Stats

Out of these entities, the following are prefilled with existing data:
- BusinessType
- Category
- DateTypes
- Language
- Localization
- PersonType
- Stats

These entities are created by users and store their information, and can modified by the current user if they have a relationship in the database:
- Dates
- Inventor
- Patent

The following entities are not currently implented, but exist to fufill business logic at a later point:
- Claims
- Classification
- PatentsToClassficiation
- RelatedPatents

