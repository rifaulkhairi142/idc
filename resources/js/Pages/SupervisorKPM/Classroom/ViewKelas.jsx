import React from "react";
import banner from "../../../../../public/assets/img_backtoschool.jpg";
import { BiTask } from "react-icons/bi";
import { Head } from "@inertiajs/react";
import ClassroomLayout from "@/Layouts/SupervisorKPM/Classroom/ClassroomLayout";


const ViewKelas = () => {
    return (
        <ClassroomLayout>
            <Head title="Tugas kelas" />
            <div className="bg-white w-full max-w-screen-lg flex flex-col gap-y-3">
                <div className="w-full relative">
                    <img
                        src={banner}
                        className="w-full relative object-cover rounded-md"
                    ></img>
                    <div className="absolute inset-0 flex flex-col justify-end text-white bg-black-2/25 rounded-md">
                        <ul className="p-4">
                            <li className="font-bold text-xl md:text-2xl lg:text-4xl ">
                                KPM Desa Sinyeu
                            </li>
                            <li className="text-md md:text-lg lg:text-xl">
                                PPKPM Ganjil 2025/2026
                            </li>
                        </ul>
                    </div>
                </div>
                {/* #129eaf */}
                <ul className="flex flex-col gap-y-3">
                    <li className="w-full border-2 rounded-lg p-3 flex gap-x-3 bg-white hover:bg-primary/5 cursor-pointer">
                        <div className="bg-[#129eaf] w-fit h-fit p-3 rounded-full">
                            <svg
                                focusable="false"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                className="fill-white"
                            >
                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z"></path>
                            </svg>
                        </div>
                        <div className="">
                            <h3 className="font-bold text-[#3c4043]">
                                Artikel
                            </h3>
                            <p className=" text-[#3c4043]">
                                Tenggat 20-02-2024
                            </p>
                        </div>
                    </li>
                    <li className="w-full border-2 rounded-lg p-3 flex gap-x-3 bg-white hover:bg-primary/5 cursor-pointer">
                        <div className="bg-[#129eaf] w-fit h-fit p-3 rounded-full">
                            <svg
                                focusable="false"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                className="fill-white"
                            >
                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z"></path>
                            </svg>
                        </div>
                        <div className="">
                            <h3 className="font-bold text-[#3c4043]">
                                Artikel
                            </h3>
                            <p className=" text-[#3c4043]">
                                Tenggat 20-02-2024
                            </p>
                        </div>
                    </li>
                    <li className="w-full border-2 rounded-lg p-3 flex gap-x-3 bg-white hover:bg-primary/5 cursor-pointer">
                        <div className="bg-[#129eaf] w-fit h-fit p-3 rounded-full">
                            <svg
                                focusable="false"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                className="fill-white"
                            >
                                <path d="M7 15h7v2H7zm0-4h10v2H7zm0-4h10v2H7z"></path>
                                <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-.14 0-.27.01-.4.04a2.008 2.008 0 0 0-1.44 1.19c-.1.23-.16.49-.16.77v14c0 .27.06.54.16.78s.25.45.43.64c.27.27.62.47 1.01.55.13.02.26.03.4.03h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7-.25c.41 0 .75.34.75.75s-.34.75-.75.75-.75-.34-.75-.75.34-.75.75-.75zM19 19H5V5h14v14z"></path>
                            </svg>
                        </div>
                        <div className="">
                            <h3 className="font-bold text-[#3c4043]">
                                Artikel
                            </h3>
                            <p className=" text-[#3c4043]">
                                Tenggat 20-02-2024
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </ClassroomLayout>
    );
};

export default ViewKelas;
