<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# YouTube Downloader GUI

This project is a YouTube Downloader Graphical User Interface (GUI) built using PHP/Laravel and Bootstrap. It allows users to download YouTube videos in various qualities with a user-friendly interface. The application leverages the power of Laravel to handle backend operations and Bootstrap to create a responsive and visually appealing frontend.

## Features

- **Simple and Intuitive Interface**: The application provides a clean and straightforward user interface for downloading YouTube videos.
- **Video Quality Selection**: Users can select the desired video quality (e.g., 1080p, 720p, 480p) from a dynamically populated dropdown menu based on the available formats of the video.
- **Direct Video URL Retrieval**: The application fetches the direct download URL for the selected video quality, making the download process seamless.
- **Error Handling**: Provides clear error messages for issues such as invalid URLs or network errors.
- **Responsive Design**: Built with Bootstrap, the GUI is fully responsive and works well on various devices, including desktops, tablets, and mobile phones.

## Installation

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/ChunkBraniac/yt-downloader.git
    cd yt-downloader-gui
    ```

2. **Install Dependencies**:
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set Up Environment Variables**:
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Configure your database and API keys in the `.env` file.

4. **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5. **Run Migrations** (if applicable):
    ```bash
    php artisan migrate
    ```

6. **Start the Development Server**:
    ```bash
    php artisan serve
    ```

7. **Access the Application**:
    - Open your browser and go to `http://127.0.0.1:8000/`.

## Usage

1. **Enter Video URL**: Paste the URL of the YouTube video you wish to download.
2. **Select Quality**: Choose the desired video quality from the dropdown menu.
3. **Submit**: Click the "Submit" button to fetch the download link.
4. **Download**: The application will display the direct download link for the selected video quality. Click the link to start the download.

## Dependencies

- **Laravel**: PHP framework for building web applications.
- **Bootstrap**: Frontend framework for responsive web design.
- **cURL**: Used for making HTTP requests to fetch video details.

## API

This application uses the [YouTube Media Downloader API](https://rapidapi.com/youtube-media-downloader-api) to fetch video details and available formats.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Acknowledgements

Special thanks to the contributors of Laravel, Bootstrap, and the YouTube Media Downloader API for their fantastic tools and services.

