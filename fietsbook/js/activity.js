// activity.js

let activityPosts = [];

function post() {
    const postText = document.getElementById("post-text").value;
    if (postText.trim() !== "") {
        const newPost = {
            text: postText,
            likes: 0,
            comments: [],
        };
        activityPosts.push(newPost);
        displayPosts();
        document.getElementById("post-text").value = ""; // Clear the input field
    }
}

function like(index) {
    activityPosts[index].likes++;
    displayPosts();
}

function comment(index, commentText) {
    if (commentText.trim() !== "") {
        activityPosts[index].comments.push(commentText);
        displayPosts();
    }
}

function displayPosts() {
    const postsContainer = document.getElementById("posts-container");
    postsContainer.innerHTML = "";

    activityPosts.forEach((post, index) => {
                const postElement = document.createElement("div");
                postElement.classList.add("post");

                postElement.innerHTML = `
            <p>${post.text}</p>
            <button onclick="like(${index})">Like (${post.likes})</button>
            <input type="text" placeholder="Add a comment..." onblur="comment(${index}, this.value)">
            <ul>
                ${post.comments.map(comment => `<li>${comment}</li>`).join("")}
            </ul>
        `;

        postsContainer.appendChild(postElement);
    });
}

// Initial display
displayPosts();