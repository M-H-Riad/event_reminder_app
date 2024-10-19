const dbName = 'EventReminderDB';
const dbVersion = 1;
let db;

// Open a database connection
const openDatabase = () => {
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(dbName, dbVersion);

        request.onerror = event => {
            console.error('Database error:', event.target.error);
            reject(event.target.error);
        };

        request.onsuccess = event => {
            db = event.target.result;
            resolve(db);
        };

        request.onupgradeneeded = event => {
            db = event.target.result;
            const objectStore = db.createObjectStore('events', { keyPath: 'id' });
            objectStore.createIndex('title', 'title', { unique: false });
        };
    });
};

// Save event offline
const saveEventOffline = (event) => {
    const transaction = db.transaction(['events'], 'readwrite');
    const objectStore = transaction.objectStore('events');
    objectStore.put(event);
};

// Get all offline events
const getOfflineEvents = () => {
    return new Promise((resolve, reject) => {
        const transaction = db.transaction(['events'], 'readonly');
        const objectStore = transaction.objectStore('events');
        const request = objectStore.getAll();

        request.onsuccess = () => {
            resolve(request.result);
        };

        request.onerror = event => {
            reject(event.target.error);
        };
    });
};
