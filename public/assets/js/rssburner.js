const rssContainer = document.getElementById('rss-container');
const rssURL = rssContainer.attributes['data-rss'].value;

// function called to display the RSS information in the DOM
const extractRSSFeed = (text) => {
  // DOMParser allows to retrieve the HTML structure from the RSS feed text (which is written in XML)
  const parser = new DOMParser();
  const doc = parser.parseFromString(text, 'application/xml');

  // information for the different episodes is stored in a <item> element
  const items = doc.querySelectorAll('item,entry');

  const markup = [...items].slice(0, 12).map((item) => {
    const { textContent: title } = item.querySelector('title');
    const { textContent: link } = item.querySelector('link');
    const { textContent: pubDate } = item.querySelector('pubDate,updated');

	const date = new Date(pubDate);

    return `
    <div class="card">
        <div class="card-body">
          <a href="${link}" class="card-title">${title}</a>
        </div>
        <div class="card-footer">
          <small class="text-muted">${date.toLocaleDateString()}</small>
        </div>
    </div>`;
  }).join('');

  // append the detailed block in the selected continer
  rssContainer.innerHTML = markup;
};

// fetch the information from the defined rssURL and call the function passing the content returned as a string
fetch(rssURL)
  .then(response => response.text())
  .then(text => extractRSSFeed(text));
