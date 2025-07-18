<?php
http_response_code(500);
include 'includes/header.php';
?>

<section class="error-section">
    <div class="container">
        <div class="error-content">
            <div class="error-animation" data-aos="fade-up">
                <div class="error-number">500</div>
                <div class="error-illustration">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <div class="error-text" data-aos="fade-up" data-aos-delay="200">
                <h1>Server Error</h1>
                <p>Something went wrong on our end. I'm already working on fixing this issue. Please try again in a few moments, or feel free to reach out if the problem persists.</p>
                <div class="error-actions">
                    <a href="/" class="btn btn-primary">
                        <i class="fas fa-refresh"></i> Try Again
                    </a>
                    <a href="#contact" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i> Report Issue
                    </a>
                </div>
            </div>
        </div>
        
        <div class="error-suggestions" data-aos="fade-up" data-aos-delay="400">
            <h3>Meanwhile, you can:</h3>
            <div class="suggestion-links">
                <a href="/" class="suggestion-item">
                    <i class="fas fa-home"></i>
                    <span>Go Home</span>
                </a>
                <a href="mailto:contact@imshivam.com" class="suggestion-item">
                    <i class="fas fa-envelope"></i>
                    <span>Email Me</span>
                </a>
                <a href="https://www.linkedin.com/in/shivampatsariya/" class="suggestion-item" target="_blank">
                    <i class="fab fa-linkedin"></i>
                    <span>LinkedIn</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.error-section {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 100px 0;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white;
}

.error-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.error-animation {
    margin-bottom: 40px;
}

.error-number {
    font-size: 8rem;
    font-weight: 700;
    background: linear-gradient(45deg, #fff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 20px;
    text-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.error-illustration {
    font-size: 4rem;
    opacity: 0.8;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.error-text h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: white;
}

.error-text p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
}

.error-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 60px;
}

.error-actions .btn {
    padding: 15px 30px;
    font-size: 1.1rem;
    min-width: 160px;
}

.error-suggestions {
    background: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.error-suggestions h3 {
    margin-bottom: 30px;
    font-size: 1.5rem;
}

.suggestion-links {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.suggestion-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
    min-width: 120px;
}

.suggestion-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-5px);
    color: white;
}

.suggestion-item i {
    font-size: 2rem;
    margin-bottom: 10px;
}

.suggestion-item span {
    font-weight: 500;
}

@media (max-width: 768px) {
    .error-number {
        font-size: 6rem;
    }
    
    .error-text h1 {
        font-size: 2rem;
    }
    
    .error-text p {
        font-size: 1rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .suggestion-links {
        flex-direction: column;
        align-items: center;
    }
    
    .error-suggestions {
        padding: 30px 20px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
