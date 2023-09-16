const container = document.querySelector('.card-container');
        const cards = document.querySelectorAll('.card');
        const cardWidth = cards[0].offsetWidth;
        const totalCards = cards.length;

        // Clone cards and append to the container to create the illusion of infinite scroll
        for (let i = 0; i < totalCards; i++) {
            container.appendChild(cards[i].cloneNode(true));
        }

        container.addEventListener('scroll', () => {
            const containerWidth = container.offsetWidth;
            const scrollLeft = container.scrollLeft;
            const totalCardsWidth = cardWidth * totalCards;

            if (scrollLeft <= 0) {
                // Scroll to the end (rightmost) for seamless infinite scroll
                container.scrollLeft = totalCardsWidth - containerWidth;
            } else if (scrollLeft + containerWidth >= totalCardsWidth) {
                // Scroll to the beginning (leftmost) for seamless infinite scroll
                container.scrollLeft = 1;
            }
        });