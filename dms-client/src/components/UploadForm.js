// src/components/UploadForm.js
import React, { useState } from 'react';
import axios from 'axios';

function UploadForm({ onUploadSuccess }) {
  const [title, setTitle] = useState('');
  const [file, setFile] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!title || !file) return alert("Please fill all fields");

    const formData = new FormData();
    formData.append('title', title);
    formData.append('file', file);

    try {
      await axios.post('http://localhost/dms-backend/upload.php', formData);
      setTitle('');
      setFile(null);
      onUploadSuccess(); // trigger refresh
    } catch (error) {
      alert('Upload failed');
      console.error(error);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="upload-form">
      <h3>Upload Document</h3>
      <input
        type="text"
        placeholder="Title"
        value={title}
        onChange={(e) => setTitle(e.target.value)}
        required
      />
      <input
        type="file"
        onChange={(e) => setFile(e.target.files[0])}
        required
      />
      <button type="submit">Upload</button>
    </form>
  );
}

export default UploadForm;
