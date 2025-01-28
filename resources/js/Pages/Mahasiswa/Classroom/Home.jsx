import ClassroomLayout from "@/Layouts/Mahasiswa/Classroom/ClassroomLayout";
import React from "react";
import banner from "../../../../../public/assets/img_backtoschool.jpg";

const Home = () => {
    return (
        <ClassroomLayout>
            <div className="bg-white w-full">
                <div className="w-full relative">
                    <img
                        src={banner}
                        className="w-full relative object-cover rounded-md"
                    ></img>
                    <div className="absolute inset-0 bg-linear-to-r from-black-2 to-black-2">
                        Test
                    </div>
                </div>
            </div>
        </ClassroomLayout>
    );
};

export default Home;
