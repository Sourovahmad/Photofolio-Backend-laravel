import React from 'react';
import { Routes,Route, Link } from 'react-router-dom';
import Profile from '../auth/profile';
import Notfound from '../error/Notfound';
import Home from '../pages/home/Home';


const Router = () => {
    return (
    <Routes>
        <Route path="/" element={<Home></Home>}/>
        <Route path="/profile" element={<Profile></Profile>}/>
        <Route path="*" element={<Notfound></Notfound>}/>
    </Routes>
    );
};

export default Router;
