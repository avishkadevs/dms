// src/pages/Dashboard.js
import React, { useState } from 'react';
import UploadForm from '../components/UploadForm';
import PaperList from '../components/PaperList';

function Dashboard() {
  const [refresh, setRefresh] = useState(false);

  const handleUploadSuccess = () => {
    setRefresh(!refresh);
  };

  return (
    <div className="dashboard">
      <h2>Cabinet Papers Dashboard</h2>
      <UploadForm onUploadSuccess={handleUploadSuccess} />
      <PaperList refresh={refresh} />
    </div>
  );
}

export default Dashboard;
