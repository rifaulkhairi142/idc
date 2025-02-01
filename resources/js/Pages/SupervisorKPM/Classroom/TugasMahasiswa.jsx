import InputError from "@/Components/InputError";
import styled from "@emotion/styled";
import { Avatar, Button, IconButton, TextField } from "@mui/material";
import React from "react";
import { useState } from "react";
import { IoCloudUploadOutline } from "react-icons/io5";
import { RiAttachment2 } from "react-icons/ri";
import { LuUser, LuUsers } from "react-icons/lu";
import { FiUser } from "react-icons/fi";
import { SendOutlined, SendSharp } from "@mui/icons-material";
import { ThreeDot } from "react-loading-indicators";
import { Head, usePage } from "@inertiajs/react";
import ClassroomLayout from "@/Layouts/SupervisorKPM/Classroom/ClassroomLayout";
import NavLink from "@/Components/SupervisorKPM/Classroom/Header/NavLink";
import { ProgressBar, Viewer, Worker } from "@react-pdf-viewer/core";
import { defaultLayoutPlugin } from "@react-pdf-viewer/default-layout";
import "@react-pdf-viewer/default-layout/lib/styles/index.css";

const VisuallyHiddenInput = styled("input")({
    clip: "rect(0 0 0 0)",
    clipPath: "inset(50%)",
    height: 1,
    overflow: "hidden",
    position: "absolute",
    bottom: 0,
    left: 0,
    whiteSpace: "nowrap",
    width: 1,
});

const TugasMahasiswa = ({ base_url }) => {
    const defaultLayoutPluginInstance = defaultLayoutPlugin();
    const [dokumen, setDokumen] = useState(null);
    const [errors, setErrors] = useState({
        dukumen: null,
        link: null,
    });
    const [loading, setLoading] = useState(false);
    const [tipeTugas, setTipeTugas] = useState("file");
    const { url, component } = usePage();
    const { pathname, search } = new URL(url, window.location.origin);

    const handleDokumenChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            if (file.type !== "application/pdf") {
                setErrors({
                    ...errors,
                    dokumen: "Only PDF Files are allowed",
                });

                return;
            }
            if (file.size > 500 * 1024) {
                setErrors({
                    ...errors,
                    dokumen: "Ukuran file tidak boleh melibihi 200kb",
                });

                return;
            }
            setDokumen(file);
            // setPayload({ ...payload, dokumen: file });
            setErrors({
                ...errors,
                dokumen: null,
            });
        }
    };
    return (
        <ClassroomLayout>
            <Head title="Detail" />
            {loading && (
                <div className="absolute z-10 w-full h-full flex items-center justify-center bg-white/70">
                    <ThreeDot color="#4F61E3" size="medium" />
                </div>
            )}
            <div className="flex w-full flex-col gap-3">
                <div className="w-full ">
                    <div className="bg-white flex justify-start ">
                        <div
                            className={`w-fit h-fit border-primary/0 border-b-2 hover:border-primary ${
                                pathname.includes("petunjuk") &&
                                "!border-primary"
                            }`}
                        >
                            <NavLink
                                href="/mahasiswa/classroom/1/task"
                                className={`group relative flex h-10 items-center gap-2.5 text-[#3c4043] px-4 font-medium duration-100 ease-in-out hover:bg-black/5 border-primary ${
                                    (pathname === "/mahasiswa/classroom" ||
                                        pathname.includes("petunjuk")) &&
                                    " !text-primary"
                                }`}
                            >
                                Petunjuk
                            </NavLink>
                        </div>
                        <div
                            className={`w-fit h-fit border-primary/0 border-b-2 hover:border-primary ${
                                pathname.includes("tugas-mahasiswa") &&
                                "!border-primary"
                            }`}
                        >
                            <NavLink
                                href="/supervisor-kpm/classroom/1/task/1/tugas-mahasiswa"
                                className={`group relative flex h-10 items-center gap-2.5 text-[#3c4043] px-4 font-medium duration-100 ease-in-out hover:bg-primary/10 border-primary ${
                                    (pathname ===
                                        "supervisor-kpm/classroom/1/task/1/tugas-mahasiswa" ||
                                        pathname.includes("tugas-mahasiswa")) &&
                                    "!text-primary"
                                }`}
                            >
                                Tugas Mahasiswa
                            </NavLink>
                        </div>
                    </div>
                </div>

                <div className="flex w-full">
                    <div className="flex w-full flex-[0.5]">
                        <ul className="flex flex-col w-full h-[80vh] min-w-67 overflow-y-auto gap-y-3">
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                            <li className="flex flex-row w-full cursor-pointer hover:shadow-lg hover:border-primary gap-x-2 border p-3 rounded-md">
                                <dvi className="flex w-full flex-row justify-between">
                                    <div className="flex w-full flex-row gap-x-2">
                                        <Avatar></Avatar>
                                        <div>
                                            <p className="text-textblack">
                                                Rifa Ulkhairi
                                            </p>
                                            <p className="text-textblack text-sm">
                                                NIM. 200205002
                                            </p>
                                        </div>
                                    </div>
                                    <p>90/100</p>
                                </dvi>
                            </li>
                        </ul>
                    </div>
                    <div className="flex w-full">
                        <div className="flex w-full overflow-y-auto h-screen p-9">
                            <Worker workerUrl="https://unpkg.com/pdfjs-dist@3.4.120/build/pdf.worker.min.js">
                                <Viewer
                                    plugins={[defaultLayoutPluginInstance]}
                                    fileUrl={`${base_url}/storage/pdf/1w0QPr17XfxvFWbSRMmbpC8AoNweee5dWXHQnyLd.pdf`}
                                    renderLoader={(percentages) => (
                                        <div style={{ width: "240px" }}>
                                            <ProgressBar
                                                progress={Math.round(
                                                    percentages
                                                )}
                                            />
                                        </div>
                                    )}
                                ></Viewer>
                            </Worker>
                        </div>
                    </div>
                    <div className="w-full flex-[1] min-w-65 rounded-lg p-5 flex gap-x-8 bg-white ">
                        <div className="flex flex-col  lg:flex-row w-full lg:cols gap-3">
                            <div className="flex w-full flex-col">
                                <div className="flex w-full flex-col gap-y-5">
                                    <div className="flex w-full justify-between">
                                        <div>
                                            <h3 className="font-bold text-[#3c4043]">
                                                Rifa Ulkhairi
                                            </h3>
                                            <h3 className="text-[#3c4043]">
                                                NIM. 200205002
                                            </h3>
                                        </div>

                                        <p className=" text-[#3c4043] ">
                                            90/100
                                        </p>
                                    </div>
                                    {/* <div className="">
                                        <p className="p-4 rounded-lg text-white cursor-pointer bg-primary w-fit h-fit">
                                            Tugas Rifa Ulkhairi
                                        </p>
                                    </div> */}
                                </div>
                                <hr className="mt-4" />
                                <div className="flex flex-col gap-2 mt-3">
                                    <div className="flex gap-x-2 items-center text-textblack">
                                        <LuUser className="text-xl" />
                                        Private Comments
                                    </div>
                                    <div></div>
                                    <div className="flex gap-x-1">
                                        <TextField
                                            size="small"
                                            label="Add Comment"
                                            sx={{
                                                width: "100%",
                                                "& .MuiOutlinedInput-root.Mui-focused":
                                                    {
                                                        outline: "none",
                                                        boxShadow: "none",
                                                    },
                                                "& .MuiInputBase-input:focus": {
                                                    outline: "none",
                                                    boxShadow: "none",
                                                },
                                            }}
                                        ></TextField>
                                        <IconButton>
                                            <SendSharp />
                                        </IconButton>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ClassroomLayout>
    );
};

export default TugasMahasiswa;
