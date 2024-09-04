  const canvas = document.getElementById('particle-canvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Particle {
    constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.vx = Math.random() * 2 - 1; // Velocity in X direction
        this.vy = Math.random() * 2 - 1; // Velocity in Y direction
        this.size = Math.random() * 5 + 2; // Size of the particle
        this.color = `rgba(255, 255, 255, ${Math.random()})`; // Color with transparency
    }

    // Add methods for updating and drawing the particle
    update() {
        this.x += this.vx;
        this.y += this.vy;

        if (this.size > 0.2) this.size -= 0.1;
    }

    draw() {
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }
}

const particles = [];

function createParticles() {
    for (let i = 0; i < 100; i++) {
        particles.push(new Particle());
    }
}

function animate() {
    requestAnimationFrame(animate);
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (const particle of particles) {
        particle.update();
        particle.draw();
    }
}

createParticles();
animate();

