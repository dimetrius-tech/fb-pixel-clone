# fb-pixel-clone
This project monitors user activity on specific pages, caches the data, and broadcasts it in real time to a dashboard accessible only to registered users.

# Features
 - Authentication(Sanctum)
 - Events
 - Real-time sync

# Tech Stack
- Frontend: Vue3, Typescript, Inertia, TailwindCSS
- Backend: Laravel
- Database: MySQL
- Other: Websockets, Laravel Sail, Laravel Horizon, Queues, Redis, Pusher

# Getting Started
### Prerequisites
- Docker installed and running
- Get installed
- No local MySQL/PostgreSQL/Redis services running (Sail provides these in containers)

### Installation
Clone the repository and switch to the project directory:
```
git clone https://github.com/dimetrius-tech/fb-pixel-clone.git
cd fb-pixel-clone
```
Copy the .env file and generate the application key:
```
cp .env.example .env
```
Start the Sail environment:
```
./vendor/bin/sail up -d
```
If Sail isn't installed yet, run:
```
composer install
```
Generate App Key & Migrate Database
```
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```
Run Queues
```
./vendor/bin/sail artisan queue:work
```
In new terminal window
```
./vendor/bin/sail artisan reverb:start
```
For horizon (if you're using it):
```
./vendor/bin/sail artisan horizon
```
Install node modules
```
npm i
```
Run for dev
```
npm run dev
```
