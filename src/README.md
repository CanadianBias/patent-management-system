# Patent Management System
*src*

- Controller contains all PHP page controllers and respective logic
- DataFixtures is unused but could be populated with sample data, but would require more logic compared to forms
- Entity contains Doctrine ORM database entities and database schema diagram
- Factory is unused, but could populate database along with DataFixtures with fake data
- Form contains form builder code to create form structure for creating users, patents, and dates
- Repository is used to run functions on database through PHP
- Kernel.php is ran by /public/index.php to start Symfony application