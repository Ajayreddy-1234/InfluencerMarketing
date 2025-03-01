# Influencer Marketing

**Influencer Marketing** is a Laravel-based web application designed to connect companies with influencers for marketing and event promotion. The platform streamlines collaboration by enabling influencers to offer services at predetermined rates and allowing companies to book these services efficiently.

## Features

- **Influencer Services**: Influencers can offer services such as Instagram Stories and WhatsApp Stories, setting their own rates through the platform.
- **Admin Controls**: Administrators have the authority to approve or block influencers, ensuring quality and compliance.
- **Link Tree Feature**: Influencers can showcase their social media profiles, allowing users to select influencers based on follower counts on specific platforms.
- **User Interaction**: Regular users can add influencer services to their cart and proceed to payment seamlessly.
- **Google Calendar Integration**: The application integrates with the Google Calendar API to schedule events or services for both influencers and regular users, ensuring timely coordination.

## Prerequisites

Before setting up the project, ensure you have the following installed:

- PHP >= 7.3
- Composer
- Node.js with npm
- A web server like Apache or Nginx
- A database system like MySQL or PostgreSQL

## Installation

### Clone the repository:

```bash
git clone https://github.com/Ajayreddy-1234/InfluencerMarketing.git
cd InfluencerMarketing
```
### Install PHP dependencies:

```bash
composer install
```

### Install Node.js dependencies:
```bash
npm install
```

### Copy the example environment file and configure:
```bash
cp .env.example .env
```
Update the .env file with your database credentials and other necessary configurations.

### Generate the application key:
```bash
php artisan key:generate
```

### Run database migrations:
```bash
php artisan migrate
```

### Compile Assets:
For Development:
```bash
npm run dev
```

### Start the Development Server:
```bash
php artisan serve
```

Access the application at http://localhost:8000


## Usage

**For Influencers:**

1. **Sign up** and create a profile.
2. **Add your services** (e.g., Instagram Stories, WhatsApp Stories) and set competitive rates.
3. Utilize the **link tree feature** to link your social media profiles, showcasing your follower counts.
4. **Manage bookings** and keep track of scheduled events through the integrated Google Calendar.

**For Companies/Users:**

1. **Sign up** and browse through available influencers.
2. Use the **link tree feature** to assess influencers based on their social media presence and follower counts.
3. **Add desired influencer services** to your cart.
4. **Proceed to payment** to confirm bookings.
5. **View and manage your scheduled events** through the integrated Google Calendar.

**For Administrators:**

1. **Monitor new influencer sign-ups**.
2. **Approve or block influencers** based on predefined criteria to maintain platform integrity.

## Contributing

I welcome contributions to enhance the platform. Please fork the repository, create a new branch for your feature or bug fix, and submit a pull request.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
