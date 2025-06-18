// src/components/PaperList.js
import React, { useEffect, useState } from 'react';
import axios from 'axios';

function PaperList({ refresh }) {
  const [papers, setPapers] = useState([]);

  useEffect(() => {
    const fetchPapers = async () => {
      try {
        const res = await axios.get('http://localhost/dms/dms-backend/list.php');
        setPapers(res.data);
      } catch (err) {
        console.error('Error fetching papers:', err);
      }
    };

    fetchPapers();
  }, [refresh]);

  return (
    <div className="paper-list">
      <h3>Uploaded Papers</h3>
      {papers.length === 0 ? (
        <p>No papers uploaded yet.</p>
      ) : (
        <ul>
          {papers.map((paper) => (
            <li key={paper.id}>
              {paper.title} - <a href={`http://localhost/dms/dms-backend/uploads/${paper.file_name}`} download>Download</a>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}

export default PaperList;
